<?php

namespace App\Models;

use App\Models\ORM;

class Article
{
    protected $table = 'articles';
    // private $title;
    // private $slug;
    // private $content;
    // private $excerpt;
    // private $country;
    // private $category;
    // private $fratured_image;
    // private $status;
    // private $author_id;
    private $orm;

    public function __construct()
    {
        $this->orm = new ORM();
        $this->orm->setTable($this->table);
    }

    public function getArticle()
    {
        return $this->orm->readArticles();
    }

    public function getRecentArticles()
    {
        return $this->orm->getRecentArticles();
    }

    public function deleteArticle($id)
    {
        return $this->orm->delete($id);
    }

    public function createArticle($data)
    {
        return $this->orm->create($data);
    }

    public function updateArticle($data, $conditions)
    {
        return $this->orm->update($data, $conditions);
    }

    public function countArticles()
    {
        return $this->orm->sum();
    }

    public function getArticleById($id)
    {
        return $this->orm->getArticlesById($id);
    }

    public function getArticleByslug($id)
    {
        return $this->orm->getArticleByslug($id);
    }

    public function getArticlesByAuthor($id)
    {
        return $this->orm->getArticlesByAuthor($id);
    }

    public function reviewArticle($status, $id)
    {
        $this->orm->update($status, $id);
    }

    public function getpublishedArticles(){
        return $this->orm->getpublishedArticles();
    }

}
