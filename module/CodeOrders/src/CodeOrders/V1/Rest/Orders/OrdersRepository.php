<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Orders;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\Hydrator\ObjectProperty;

/**
 * Description of OrdersRepository
 *
 * @author PedroHenrique
 */
class OrdersRepository {

    /**
     * @var AbstractTableGateway
     */
    private $orderItemTableGateway;

    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;

    public function __construct(AbstractTableGateway $tableGateway, AbstractTableGateway $orderItemTableGateway) {
        
        $this->tableGateway = $tableGateway;
        $this->orderItemTableGateway = $orderItemTableGateway;
    }

    public function findAll() {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));
        $orders = $this->tableGateway->select();
        
        $res = [];
        foreach ($orders as $order) {
            
            $items = $this->orderItemTableGateway->select(['order_id' => $order->getId()]);
            
            foreach ($items as $item) {
                $order->addItems($item);
            }
           
            $data = $hydrator->extract($order);
            
            $res[] = $data;
            
        }
        $arrayAdapter = new ArrayAdapter($res);
        $ordersCollection = new OrdersCollection($arrayAdapter);
        
        return $ordersCollection;
        
    }
    
    public function insert(array $data) {
        
        $this->tableGateway->insert($data);
        $id = $this->tableGateway->getLastInsertValue();
        return $id;
    }
    
    public function insertItem(array $data) {
        
        $this->orderItemTableGateway->insert($data);
        $id = $this->orderItemTableGateway->getLastInsertValue();
        return $id;
    }
    
    public function getTablegateway() {
        return $this->tableGateway;
    }
    
}
