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
 * Description of OrdersRepositoryFactory
 *
 * @author PedroHenrique
 */
class OrdersRepositoryFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $dbAdapter = $serviceLocator->get('DbAdapter');
        
        $hydrator = new HydratingResultSet(new ClassMethods(), new OrdersEntity());
        
        $tableGateway = new TableGateway('orders', $dbAdapter, null, $hydrator);
        
        $orderItemTableGateway =  $serviceLocator->get('CodeOrders\\V1\\Rest\\Orders\\OrderItemTableGateway');
        
        return new OrdersRepository($tableGateway, $orderItemTableGateway);
        
    }
    
}
