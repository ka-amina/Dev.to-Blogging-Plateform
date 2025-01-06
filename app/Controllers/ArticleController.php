<?php

namespace App\Controllers;

use App\Models\Article;

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

    public function deleteArticle($id)
    {
        if (isset($_GET['id'])) {
            $id = ['id' => $_GET['id']];
            $this->article->deleteArticle($id);
            header("Location: articles.php");
            exit();
        }
    }

    public function createArticle($data)
    {
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
                'author_id' => 7
            ];
            $this->article->createArticle($data);
            header("Location: articles.php");
            exit();
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
                'author_id' => $author_id
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
}
