<?php
namespace App\Models;

use App\Models\ORM;

class Category {
    protected $table = 'categories';
    protected $id;
    protected $name;
    protected $orm;

    public function __construct() {
        $this->orm = new ORM();
        $this->orm->setTable($this->table); 
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getCategories() {
        return $this->orm->read();
    }

    public function deleteCategory($id){
        return $this->orm->delete($id);
    }

    public function createCategory($data){
        return $this->orm->create($data);
    }

    public function updateCategory($data, $conditions){
        return $this->orm->update($data, $conditions);
    }

    public function countCategories(){
        return $this->orm->sum();
    }

    public function getCategryById($id){
        return $this->orm->getById($id);
    }
}
