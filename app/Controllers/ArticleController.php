<?php

namespace App\Controllers;

use App\Models\Article;
use App\Controllers\userController;



class ArticleController
{
    protected $article;


    public function __construct()
    {
        $this->article = new Article();
    }

    public function listArticles()
    {
        return $this->article->getArticle();
    }

    public function getRecentArticles()
    {
        return $this->article->getRecentArticles();
    }
    public function getLastArticleId()
    {
        return $this->article->getLastArticleId();
    }

    public function deleteArticle($id)
    {
        if (isset($_GET['id'])) {
            $id = ['id' => $_GET['id']];
            $this->article->deleteArticle($id);
            header("Location: articles.php");
            exit();
        }
    }

    public function createArticleTags($data){
        return $this->article->createArticleTags($data);
    }

    public function createArticle($data)
    {
        // session_start();
        $image = $_FILES['image']['name'];
        $temp_file = $_FILES['image']['tmp_name'];
        $folder = "../assets/articleimages/$image";
        move_uploaded_file($temp_file, $folder);

        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $content = $_POST['content'];
        $excerpt = $_POST['excerpt'];
        $meta_description = $_POST['meta_description'];
        $category = $_POST['category'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'excerpt' => $excerpt,
                'meta_description' => $meta_description,
                'category_id' => $category,
                'featured_image' => $image,
                'author_id' => $_SESSION["id_author"]
            ];
            $is_created = $this->article->createArticle($data);
            // if ($is_created) {
            //     $last_article= $this->article->getLastArticleId();
            //     $last_article_id=$last_article['id'];
            //     if (isset($_POST['tags_id']) && !empty($_POST['tags_id'])) {
            //         foreach ($_POST['tags_id'] as $tagId) {
            //             // print_r($_POST['tags_id']);
            //             $tags = [
            //                 'article_id' => $last_article_id,
            //                 'tag_id' => $tagId
            //             ];
            //             // print_r($tags);
            //             $this->article->createArticleTags($tags);
            //         }
            //     }
                
                
            // }
            
        }
    }

    public function updateArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                // If a new image is uploaded
                $image = $_FILES['image']['name'];
                $temp_file = $_FILES['image']['tmp_name'];
                $folder = "../assets/articleimages/$image";
                move_uploaded_file($temp_file, $folder);
            } else {
                // Use the existing image
                $image = $_POST['old_image'];
            }
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $content = $_POST['content'];
            $author_id = $_POST['author_id'];
            $excerpt = $_POST['excerpt'];
            $meta_description = $_POST['meta_description'];
            $category = $_POST['category'];
            $data = [
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'excerpt' => $excerpt,
                'meta_description' => $meta_description,
                'category_id' => $category,
                'featured_image' => $image,
                'author_id' => $_SESSION["id_author"]
            ];
            $this->article->updateArticle($data, ['id' => $_GET['id']]);
            header("Location: articles.php");
            exit();
        }
    }

    public function countArticles()
    {
        return $this->article->countArticles();
    }

    public function getArticleById($id)
    {
        return $this->article->getArticleById($id);
    }

    public function getArticleByslug($id)
    {
        return $this->article->getArticleByslug($id);
    }

    public function getArticlesByAuthor($id)
    {
        return $this->article->getArticlesByAuthor($id);
    }

    public function reviewArticle($status, $id)
    {
        return $this->article->reviewArticle($status, $id);
    }

    public function getpublishedArticles()
    {
        return $this->article->getpublishedArticles();
    }
}
