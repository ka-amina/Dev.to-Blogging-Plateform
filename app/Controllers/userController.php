<?php

namespace App\Controllers;

use App\Models\user;

class userController
{

    protected $user;

    public function __construct()
    {
        $this->user = new user();
    }

    public function crateUser($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $data = [
                'username' => $_POST['name'],
                'email' => $_POST['email'],
                'password_hash' => $Hashedpassword,
                'role' => 'author'
            ];
            $this->user->register($data);
            header("Location: dashboard.php");
            exit();
        }
    }
}
