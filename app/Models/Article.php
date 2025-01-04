<?php
namespace App\Models;

use App\Models\ORM;

class Article{
    protected $table = 'articles';
    private $title;
    private $slug;
    private $content;
    private $excerpt;
    private $country;
    private $category;
    private $fratured_image;
    private $status;
    private $author_id;
    private $orm;

   public function __construct(){
    $this->orm= new ORM();
    $this->orm->setTable($this->table);
   }
   
   public function getArticle(){
    return $this->orm->readArticles();
   }

   public function deleteArticle($id){
    return $this->orm->delete($id);
   }

   public function createArticle($data){
    return $this->orm->create($data);
   }

}


?>