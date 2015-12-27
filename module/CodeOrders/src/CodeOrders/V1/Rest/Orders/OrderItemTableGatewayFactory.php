<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Orders;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\TableGateway\TableGateway;


/**
 * Description of OrderItemTableGatewayFactory
 *
 * @author PedroHenrique
 */
class OrderItemTableGatewayFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $dbAdapter = $serviceLocator->get('DbAdapter');
        
        $hydrator = new HydratingResultSet(new ClassMethods(), new OrderItemEntity());
        
        $tableGateway = new TableGateway('order_items', $dbAdapter, null, $hydrator);
        
        return $tableGateway;
        
    }
    
}
