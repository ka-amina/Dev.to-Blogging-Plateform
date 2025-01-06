<?php

namespace App\Controllers;

use App\Models\Tag;

class TagController
{
    protected $tag;

    public function __construct()
    {
        $this->tag =  new Tag();
    }

    public function listTags()
    {
        return $this->tag->getTags();
    }

    public function deleteTag($id)
    {
        if (isset($_GET['id'])){
            $id=['id'=>$_GET['id']];
            $this->tag->deleteTag($id);
            header("Location: tags.php");
            exit();
        }
    }

    public function createTag($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['tagName']
            ];
            $this->tag->createTag($data);
            header("Location: tags.php");
            exit();
        }
    }

    public function updateTag()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tag->updateTag(
                ['name' => $_POST['tagName']],
                ['id' => $_GET['id']]
            );
            header("Location: tags.php");
            exit();
        }
        
       
    }

    public function sumTags()
    {
        return $this->tag->sumTags();
    }

    public function getTagById($id)
    {
        return $this->tag->getTagById($id);
    }
}
