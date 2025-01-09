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

    public function login()
    {
        // session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->user->login($email, $password);


            if ($user) {
                $_SESSION["role"] = $user["role"];
                $_SESSION["id_author"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["email"] = $user["email"];

                if ($_SESSION['role'] == 'admin') {
                    header("Location: dashboard.php");
                } elseif ($_SESSION['role'] == 'author') {
                    header("Location: authorArticles.php");
                }
                exit();
            } else {
                $_SESSION['error'] = 'Invalid email or password.';
                header("Location: home.php");
            }
        }
    }

    public function incrementViews($id)
    {
        return $this->user->incremetViews($id);
    }

    public function showUsers()
    {
        return $this->user->showUsers();
    }

    public function deleteUser($id)
    {
        if (isset($_GET['id'])) {
            $id = ['id' => $_GET['id']];
            $this->user->deleteUdser($id);
            header("location: users.php");
            exit();
        }
    }

    public function createUser($data)
    {
        $image = $_FILES['image']['name'];
        $temp_file = $_FILES['image']['tmp_name'];
        $folder = "../assets/articleimages/$image";
        move_uploaded_file($temp_file, $folder);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $bio = $_POST['bio'];
        $role = 'author';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => $username,
                'email' => $email,
                'password_hash' => $password,
                'bio' => $bio,
                'role' => $role,
                'profile_picture_url' => $image,
            ];
            $this->user->createUser($data);
            header("Location: users.php");
            exit();
        }
    }

    public function getUserById($id)
    {
        return $this->user->getUserById($id);
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                // If a new image is uploaded
                $image = $_FILES['image']['name'];
                $temp_file = $_FILES['image']['tmp_name'];
                $folder = "../assets/articleimages/$image";
                move_uploaded_file($temp_file, $folder);
            } else {
                // Use the existing image
                $image = $_GET['old_image'];
            }
            if(isset($_POST['password'])){
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                $password= $_GET['old_password']; 
            }
            $username = $_POST['username'];
            $email = $_POST['email'];
            // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $bio = $_POST['bio'];
            $role = $_POST['role'];
            $data = [
                'username' => $username,
                'email' => $email,
                'password_hash' => $password,
                'bio' => $bio,
                'role' => $role,
                'profile_picture_url' => $image,
            ];
            $this->user->updateUser($data, ['id' => $_GET['id']]);
            header("Location: users.php");
            exit();
        }
    }

    // public function logout()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         session_start();
            
    //         header('Location: login.php');
    //         exit();
    //     }
    // }
}
