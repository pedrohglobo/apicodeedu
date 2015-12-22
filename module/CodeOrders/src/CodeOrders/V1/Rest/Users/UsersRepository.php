<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Users;

use \Zend\Db\TableGateway\TableGatewayInterface;
use \Zend\Paginator\Adapter\DbTableGateway;
/**
 * Description of UsersRepository
 *
 * @author PedroHenrique
 */
class UsersRepository {

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
        
        
        return new UsersCollection($paginatorAdapter);
//        return $this->tableGateway->select();
    }
    
    public function find($id) {
        
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);
        
        return $resultSet->current();
        
    }

}
