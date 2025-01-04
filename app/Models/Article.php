<?php
namespace App\Models;

use App\Models\ORM;

class Article{
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
   }
   
   public function getArticle(){
    return $this->orm->readArticles();
   }
}


?>