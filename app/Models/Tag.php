<?php
namespace App\Models;

use App\Models\ORM;

class Tag {
    protected $id;
    protected $name;
    protected $table='tags';
    protected $orm;

    public function __construct() {
        $this->orm= new ORM();
        $this->orm->setTable($this->table);
    }

    public function setTagName($name){
        $this->name=$name;
    }
    public function getTagName(){
        return $this-> name;
    } 

    public function  getTags(){
        return $this->orm->read();
    }

    public function deleteTag($id){
        return $this->orm->delete($id);
    }

    public function createTag($data){
        return $this->orm->create($data);
    }

    public function updateTag($data,$conditions){
        return $this->orm->update($data, $conditions);
    }
    
    public function sumTags(){
        return $this->orm->sum();
    }

    public function getTagById($id){
        return $this->orm->getById($id);
    }
}


?>