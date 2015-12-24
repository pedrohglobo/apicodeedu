<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Products;

use \Zend\ServiceManager\FactoryInterface;
use \Zend\ServiceManager\ServiceLocatorInterface;
use \Zend\Db\ResultSet\HydratingResultSet;
use \Zend\Db\TableGateway\TableGateway;
/**
 * Description of ProductsRepositoryFactory
 *
 * @author PedroHenrique
 */
class ProductsRepositoryFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $dbAdapter = $serviceLocator->get('DbAdapter');
        $productsMapper = new ProductsMapper();
        $hydrator = new HydratingResultSet($productsMapper, new ProductsEntity());
        
        $tableGateway = new TableGateway('products', $dbAdapter, null, $hydrator);
        
        $productsRepository = new ProductsRepository($tableGateway);
        
        return $productsRepository;
        
    }

//put your code here
}
