<?php
namespace CodeOrders\V1\Rest\Users;

class UsersEntity
{
    protected $id;
    protected $username;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $role;
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getRole() {
        return $this->role;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
        return $this;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }


}