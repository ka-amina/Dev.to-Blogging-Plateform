<?php
namespace App\Controllers;

use App\Models\Admin;

class AdminController{
    protected $review;
    
    public function __construct()
    {
        $this->review= new Admin();
    }

    public function reviewArticle($status, $id){
        return $this->review->reviewArticle($status,$id);
    }
}
?>