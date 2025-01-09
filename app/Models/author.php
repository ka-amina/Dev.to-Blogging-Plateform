<?php
namespace App\Models;

// use App\Models\ORM;
use App\Models\user;

class author extends user{

    public function __construct(){
        parent::__construct();
    }

    public function updateUser($data, $conditions){
       return $this->orm->update($data, $conditions);
    }
}

?>