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
}
