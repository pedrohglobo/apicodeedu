<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Orders;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
/**
 * Description of OrderItemHydratorStrategy
 *
 * @author PedroHenrique
 */
class OrderItemHydratorStrategy implements StrategyInterface{

    /**
     * @var ClassMethods
     */
    private $hydrator;

    public function __construct(ClassMethods $hydrator) {
        
        $this->hydrator = $hydrator;
    }

    
    public function extract($items) {
        
        $data = [];
        
        foreach ($items as $item) {
            $data[] = $this->hydrator->extract($item);
        }
        
        return $data;
        
    }

    public function hydrate($value) {
//        throw new \RuntimeException('não é possivel hidratar objeto');
    }

}
