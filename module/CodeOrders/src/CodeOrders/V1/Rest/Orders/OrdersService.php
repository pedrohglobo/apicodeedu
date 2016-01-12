<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Orders;

use Zend\Stdlib\Hydrator\ObjectProperty;
use ZF\ApiProblem\ApiProblem;

/**
 * Description of OrdersService
 *
 * @author PedroHenrique
 */
class OrdersService {

    /**
     * @var OrdersRepository
     */
    private $repository;

    public function __construct(OrdersRepository $repository) {
        
        $this->repository = $repository;
        
    }
    
    public function insert($data) {
        
        
        $hydrator = new ObjectProperty();
        $array = $hydrator->extract($data);
        
        $orderData = $array;
        unset($orderData['item']);
        $items = $array['item'];
        
        $tableGateway = $this->repository->getTablegateway();
        
        try {
            $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
            
            $orderId = $this->repository->insert($orderData);

            foreach ($items as $item) {
                $item['order_id'] = $orderId;
                $this->repository->insertItem($item);

            }
            $tableGateway->getAdapter()->getDriver()->getConnection()->commit();
            return ['order_id' => $orderId];
            
        } catch (\Exception $exc) {
            $tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
            return 'error';
//            echo $exc->getTraceAsString();
        }
        
    }
    
    
    public function delete($id)
    {
        $tableGateway = $this->repository->getTableGateway();
        
        $existe = $tableGateway->select(['id' => (int)$id]);
        if(count($existe) === 1){
            try {
                $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
                $orderItemTablegateway = $this->repository->getOrderItemTablegateway();
                $items = $this->repository->getOrderItems($id);
                foreach ($items as $item) {
                    $orderItemTablegateway->delete(['id' => (int)$item->getId()]);
                }
                $tableGateway->delete(['id' => (int)$id]);
                $tableGateway->getAdapter()->getDriver()->getConnection()->commit();
                return true;
            } catch (\Exception $e) {
                $tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
                return new ApiProblem(450, 'Não foi possivel excluir o registro',null,'Problemas ao excluir');
            }
        }
        return new ApiProblem(451, 'O registro não foi encontrado na base de dados',null,'Registro não encontrado');
        
    }
    
    
    public function update($id, $data) {
        
        
        $hydrator = new ObjectProperty();
        $array = $hydrator->extract($data);
        
        $orderData = $array;
        unset($orderData['item']);
        $items = $array['item'];
        
        $tableGateway = $this->repository->getTablegateway();
        
        try {
            $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
            
            $itensAtuais = $this->repository->getOrderItems($id);
            
            foreach ($items as $item) {
                $item['order_id'] = $id;
                $buscaItem = $this->repository->getOrderItemTablegateway()->select(['order_id' => $item['order_id'],'product_id' => $item['product_id']]);
                $idItem = 0;
                if(count($buscaItem) > 0){
                    $idItem = (int)$buscaItem->current()->getId();
                    $this->repository->getOrderItemTablegateway()->update($item,['id' => $idItem]);
                }else{
                    $this->repository->insertItem($item);
                }
                if(isset($itensAtuais[$idItem])){
                    unset($itensAtuais[$idItem]);
                }
            }
            foreach ($itensAtuais as $itemExcluir) {
                $this->repository->getOrderItemTablegateway()->delete(['id' => $itemExcluir['id']]);
            }
            $this->repository->update($id, $orderData);
            $tableGateway->getAdapter()->getDriver()->getConnection()->commit();
            return ['order_id' => $id];
            
        } catch (\Exception $exc) {
            $tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
            return 'error';
//            echo $exc->getTraceAsString();
        }
        
    }
    


}
