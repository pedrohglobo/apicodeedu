<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Description of OrdersServiceFactory
 *
 * @author PedroHenrique
 */
class OrdersServiceFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $ordersRepository = $serviceLocator->get('CodeOrders\\V1\\Rest\\Orders\\OrdersRepository');
        
        return new OrdersService($ordersRepository);
        
    }

//put your code here
}
