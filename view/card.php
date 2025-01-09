<?php
require_once '../app/config/connexion.php';
require '../vendor/autoload.php';

use App\Controllers\ArticleController;
use App\Controllers\userController;

$user = new userController();
$articlesList = new ArticleController();
$user->incrementViews($_GET['id']);
$articleInfo = $articlesList->getArticleById($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="px-2 py-20 w-full flex justify-center">
    <div class="bg-white lg:mx-8 lg:flex lg:max-w-5xl lg:shadow-lg rounded-lg">
        <div class="lg:w-1/2">
            <img src="../assets/articleimages/<?= $articleInfo['image'] ?>" alt="" width="500" height="400">
        </div>
        <div class="py-12 px-6 lg:px-12 max-w-xl lg:max-w-5xl lg:w-1/2 rounded-t-none border lg:rounded-lg">
            <h2 class="text-3xl text-gray-800 font-bold">
                <?= $articleInfo['title']?>
            </h2>
            <span>Category: <?= $articleInfo['category_name']?> </span>

            
            <p class="mt-4 text-gray-600 ">
               <?= $articleInfo['content']?>
            </p>
            
            <div class="mt-8">
                <a href="home.php" class="bg-gray-900 text-gray-100 px-5 py-3 font-semibold rounded">back to home</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>