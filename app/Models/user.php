<?php
namespace App\Models;

use App\Models\ORM;

class user {
 protected $username;
 protected $email;
 protected $password;
 protected $roel_name;
 protected $table='users';
 protected $orm;

 public function __construct() {
    $this->orm= new ORM();
    $this->orm->setTable($this->table);
}


public function register($data){
    return $this->orm->create($data);
}

public function login($email,$password){
return $this->orm->login($email,$password);
}

}



?>