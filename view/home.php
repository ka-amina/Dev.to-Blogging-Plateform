<?php
require_once '../app/config/connexion.php';
require '../vendor/autoload.php';

use App\Controllers\CategoryController;
use App\Controllers\TagController;


$controller = new CategoryController();
$Tag=new TagController;

// $categories = $controller->listCategories();
// print_r($categories);

// $controller->deleteCategory(['id' => 2]);
// $controller->createCategory(['name'=> 'cyber security']);
// $controller->updateCategory(['name'=>'test'],['id'=>6]) ;

// tags
$tags= $Tag->listTags();
print_r($tags);

// $Tag->deleteTag(['id'=> 8 ]);
// $Tag->createTag(['name'=>'hi']);

$Tag->updateTag(['name'=> 'smile'], ['id'=>11]);