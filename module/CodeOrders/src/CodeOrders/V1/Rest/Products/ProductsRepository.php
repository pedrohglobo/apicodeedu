<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Products;

use \Zend\Db\TableGateway\TableGatewayInterface;
use \Zend\Paginator\Adapter\DbTableGateway;
use \Zend\Stdlib\Hydrator\ObjectProperty;
use ZF\ApiProblem\ApiProblem;
/**
 * Description of ProductsRepository
 *
 * @author PedroHenrique
 */
class ProductsRepository {

    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        
        $this->tableGateway = $tableGateway;
    }
    
    public function findAll() {
        
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);
        
        
        return new ProductsCollection($paginatorAdapter);
//        return $this->tableGateway->select();
    }
    
    public function find($id) {
        
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);
        
        return $resultSet->current();
        
    }
    
    public function insert($data) {
        
        $hydrator = new ObjectProperty();
        $array = $hydrator->extract($data);
        
        return $this->tableGateway->insert($array);
        
    }
    
    
    public function update($id, $data) {
        
        $hydrator = new ObjectProperty();
        $array = $hydrator->extract($data);
        
        return $this->tableGateway->update($array,['id' => (int)$id]);
        
    }
    
    public function delete($id) {
        
        $existe = $this->tableGateway->select(['id' => (int)$id]);
        if(count($existe) === 1){
            $this->tableGateway->delete(['id' => (int)$id]);
            $existe = $this->tableGateway->select(['id' => (int)$id]);
            if(count($existe) === 1){
                return new ApiProblem(450, 'Não foi possivel excluir o registro',null,'Problemas ao excluir');
            }
            return true;
        }
        return new ApiProblem(451, 'O registro não foi encontrado na base de dados',null,'Registro não encontrado');
        
    }
    

}
