<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Users;

use \Zend\ServiceManager\FactoryInterface;
use \Zend\ServiceManager\ServiceLocatorInterface;
use \Zend\Db\ResultSet\HydratingResultSet;
use \Zend\Db\TableGateway\TableGateway;
/**
 * Description of UsersRepositoryFactory
 *
 * @author PedroHenrique
 */
class UsersRepositoryFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $dbAdapter = $serviceLocator->get('DbAdapter');
        $usersMapper = new UsersMapper();
        $hydrator = new HydratingResultSet($usersMapper, new UsersEntity());
        
        $tableGateway = new TableGateway('oauth_users', $dbAdapter, null, $hydrator);
        
        $usersRepository = new UsersRepository($tableGateway);
        
        return $usersRepository;
        
    }

//put your code here
}
