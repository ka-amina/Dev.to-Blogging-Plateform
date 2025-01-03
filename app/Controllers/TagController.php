<?php
namespace App\Controllers;

use App\Models\Tag;

class TagController{
    protected $tag;

    public function __construct(){
        $this->tag =  new Tag(); 
    }

    public function listTags(){
        return $this->tag->getTags();
    }
    
    public function deleteTag($id){
        $this->tag->deleteTag($id);
    }
}


?>