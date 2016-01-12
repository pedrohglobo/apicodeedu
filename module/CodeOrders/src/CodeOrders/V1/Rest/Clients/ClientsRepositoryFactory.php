<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Clients;

use \Zend\ServiceManager\FactoryInterface;
use \Zend\ServiceManager\ServiceLocatorInterface;
use \Zend\Db\ResultSet\HydratingResultSet;
use \Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;
/**
 * Description of ClientsRepositoryFactory
 *
 * @author PedroHenrique
 */
class ClientsRepositoryFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $dbAdapter = $serviceLocator->get('DbAdapter');
        
        $hydrator = new HydratingResultSet(new ClassMethods(), new ClientsEntity());
        
        $tableGateway = new TableGateway('clients', $dbAdapter, null, $hydrator);
        
        $clientsRepository = new ClientsRepository($tableGateway);
        
        return $clientsRepository;
        
    }

//put your code here
}
