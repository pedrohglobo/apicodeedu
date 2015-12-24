<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Products;

use \Zend\Stdlib\Hydrator\HydratorInterface;
/**
 * Description of ProductsMapper
 *
 * @author PedroHenrique
 */
class ProductsMapper  extends ProductsEntity implements HydratorInterface{
    //put your code here
    
    public function extract($object) {
        
        return [
            'id'          => $object->id,
            'name'        => $object->name,
            'description' => $object->description,
            'price'       => $object->price,
        ];
        
    }
    
    public function hydrate(array $data, $object) {
        
        $object->id          = $data['id'];
        $object->name        = $data['name'];
        $object->description = $data['description'];
        $object->price       = $data['price'];
        
        return $object;
    }
    
}
