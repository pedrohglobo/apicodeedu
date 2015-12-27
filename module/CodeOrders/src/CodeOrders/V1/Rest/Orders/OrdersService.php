<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Orders;

use Zend\Stdlib\Hydrator\ObjectProperty;

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

}
