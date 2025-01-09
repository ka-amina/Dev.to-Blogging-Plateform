<?php

namespace App\Models;

use App\Models\ORM;
use PDO;

class user
{
    protected $username;
    protected $email;
    protected $password;
    protected $roel_name;
    protected $table = 'users';
    protected $orm;

    public function __construct()
    {
        $this->orm = new ORM();
        $this->orm->setTable($this->table);
    }


    public function register($data)
    {
        return $this->orm->create($data);
    }

    public function login($email, $password)
    {
        return $this->orm->login($email, $password);
    }

    public function incremetViews($id){
        return $this->orm->incrementViews($id);
    }

    public function showUsers(){
        return $this->orm->read();
    }

    public function getTopUsers(){
        return $this->orm->getTopUsers();
    }

    public function deleteUdser($id){
        return $this->orm->delete($id);
    }

    public function createUser($data){
        return $this->orm->create($data);
    }

    public function getUserById($id){
        return $this->orm->getById($id);
    }

    public function updateUser($data,$conditions){
        return $this->orm->update($data, $conditions);
    }

    public function countUsers(){
        return $this->orm->sum();
    }
}
