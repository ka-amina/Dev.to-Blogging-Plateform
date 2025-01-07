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
    
    public function login() {
        // session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->user->login($email, $password);
           

            if ($user) {
                $_SESSION["role"] = $user["role"];
                $_SESSION["id_author"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                if ($_SESSION['role'] == 'admin') {
                    header("Location: dashboard.php");
                } elseif ($_SESSION['role'] == 'author') {
                    header("Location: articles.php");
                }
                exit();
            } else {
                $_SESSION['error'] = 'Invalid email or password.';
                header("Location: home.php");
            }
        }
    }
    
}
