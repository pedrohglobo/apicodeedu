<?php
namespace CodeOrders\V1\Rest\Clients;

class ClientsEntity
{
    protected $id;
    protected $name;
    protected $document;
    protected $address;
    protected $zipcode;
    protected $city;
    protected $state;
    protected $responsible;
    protected $email;
    protected $phone;
    protected $obs;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDocument() {
        return $this->document;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getZipcode() {
        return $this->zipcode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getState() {
        return $this->state;
    }

    public function getResponsible() {
        return $this->responsible;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDocument($document) {
        $this->document = $document;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
        return $this;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    public function setResponsible($responsible) {
        $this->responsible = $responsible;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    public function setObs($obs) {
        $this->obs = $obs;
        return $this;
    }

}