<?php
namespace App\Controllers;

use App\Models\Article;

class ArticleController {
    protected $article;

    public function __construct(){
        $this->article= new Article();
    }
    
    public function listArticles(){
        return $this->article->getArticle();
    }

    public function deleteArticle($id){
        $this->article->deleteArticle($id);
    }
    
    public function createArticle($data){
        $this->article->createArticle($data);
    }

    public function updateArticle($data,$conditions){
        $this->article->updateArticle($data,$conditions);
    }

    public function countArticles(){
       return $this->article->countArticles();
    }
}


?>