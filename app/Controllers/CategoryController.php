<?php
namespace App\Controllers;

use App\Models\Category;

class CategoryController {
    protected $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function listCategories() {
        return $this->category->getCategories();
    }
    
    public function deleteCategory($id){
        if (isset($_GET['id'])){
            $id=['id'=>$_GET['id']];
            $this->category-> deleteCategory($id);
            header("Location: categories.php");
            exit();
        }
        
    }

    public function createCategory($data){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['categoryName']
            ];
            $this->category->createCategory($data);
            header("Location: categories.php");
            exit();
        }
    }

    public function updateCategory(){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->category->updateCategory(['name' => $_POST['categoryName']],['id' => $_GET['id']]);
            header("Location: categories.php");
            exit();
        }
    }

    public function countCategories(){
        return $this->category->countCategories();
    }

    public function getCategoryById($id){
        return $this->category->getCategryById($id);
    }
}
