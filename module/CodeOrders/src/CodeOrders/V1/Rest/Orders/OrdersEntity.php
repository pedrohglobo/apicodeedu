<?php
namespace CodeOrders\V1\Rest\Orders;

class OrdersEntity
{
    protected $id;
    protected $client_id;
    protected $user_id;
    protected $ptype_id;
    protected $total;
    protected $status;
    protected $created_at;
    protected $items;

    public function __construct() {
        $this->items = [];
    }
    public function getId() {
        return $this->id;
    }

    public function getClientId() {
        return $this->client_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getPtypeId() {
        return $this->ptype_id;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getItems() {
        return $this->items;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setClientId($client_id) {
        $this->client_id = $client_id;
        return $this;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
        return $this;
    }

    public function setPtypeId($ptype_id) {
        $this->ptype_id = $ptype_id;
        return $this;
    }

    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
        return $this;
    }

    public function addItems($item) {
        $this->items[] = $item;
        return $this;
    }


}
