<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeOrders\V1\Rest\Orders;

/**
 * Description of OrderItemEntity
 *
 * @author PedroHenrique
 */
class OrderItemEntity {
    
    protected $id;
    protected $order_id;
    protected $product_id;
    protected $quantity;
    protected $price;
    protected $total;

    public function getId() {
        return $this->id;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setOrderId($order_id) {
        $this->order_id = $order_id;
        return $this;
    }

    public function setProductId($product_id) {
        $this->product_id = $product_id;
        return $this;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }



}
