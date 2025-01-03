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
}
