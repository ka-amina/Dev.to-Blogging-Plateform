<?php
require_once '../app/config/connexion.php';
require '../vendor/autoload.php';

use App\Controllers\CategoryController;
use App\Controllers\TagController;
use App\Controllers\ArticleController;


$controller = new CategoryController();
$Tag=new TagController;
$article= new ArticleController();

// $categories = $controller->listCategories();
// print_r($categories);

// $controller->deleteCategory(['id' => 2]);
// $controller->createCategory(['name'=> 'cyber security']);
// $controller->updateCategory(['name'=>'test'],['id'=>6]) ;

// tags
// $tags= $Tag->listTags();
// print_r($tags);

// $Tag->deleteTag(['id'=> 8 ]);
// $Tag->createTag(['name'=>'hi']);

// $Tag->updateTag(['name'=> 'smile'], ['id'=>11]);

// articles
$articles= $Tag->listTags();
foreach ($articles as $article) {
    echo "Article ID: " . $article['id'] . "<br>";  // Display article id
}

// $article->deleteArticle(['id'=>5]);

// $article->createArticle(['title'=>'Getting Started with React Hooks','slug'=>'test','content'=>'React Hooks are a powerful feature that allows you to use state and other React features without writing a class component...','excerpt'=>'Learn how to use React Hooks in your applications','meta_description'=>'A comprehensive guide to React Hooks for beginners','category_id'=>1,'featured_image'=>'images/react-hooks.jpg','status'=>'published','scheduled_date'=>NULL,'author_id'=>'5']);

// $article->updateArticle(['slug'=>'test2'],['id'=>9]);
$articleCount = $article->countArticles();
print_r($articleCount);