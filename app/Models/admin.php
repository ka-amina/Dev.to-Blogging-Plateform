<?php
namespace App\Models;

use App\Models\ORM;
use App\Models\user;

class Admin extends user{
    // protected $user;
    protected $table='articles';
public function __construct(){
    parent::__construct();
    $this->orm->setTable($this->table);
}

public function AddUser($data){
$this->orm->create($data);
}


public function deleteUser($id){
    $this->orm->delete($id);
}

public function reviewArticle($status,$id){
    $this->orm->update($status,$id);
}

    
}

?>