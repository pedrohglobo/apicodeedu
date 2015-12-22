<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Users;

use \Zend\Stdlib\Hydrator\HydratorInterface;
/**
 * Description of UsersMapper
 *
 * @author PedroHenrique
 */
class UsersMapper  extends UsersEntity implements HydratorInterface{
    //put your code here
    
    public function extract($object) {
        
        return [
            'id'         => $object->id,
            'username'   => $object->username,
            'password'   => $object->password,
            'first_name' => $object->first_name,
            'last_name'  => $object->last_name,
            'role'       => $object->role,
        ];
        
    }
    
    public function hydrate(array $data, $object) {
        
        $object->id = $data['id'];
        $object->username = $data['username'];
        $object->password = $data['password'];
        $object->first_name = $data['first_name'];
        $object->last_name = $data['last_name'];
        $object->role = $data['role'];
        
        return $object;
    }
    
}
