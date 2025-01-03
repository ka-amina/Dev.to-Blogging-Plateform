<?php
require_once '../app/config/connexion.php';
require '../vendor/autoload.php';

use App\Controllers\CategoryController;


$controller = new CategoryController();

// $categories = $controller->listCategories();
// print_r($categories);

// $controller->deleteCategory(['id' => 2]);
// $controller->createCategory(['name'=> 'cyber security']);
$controller->updateCategory(['name'=>'test'],['id'=>6]) ;