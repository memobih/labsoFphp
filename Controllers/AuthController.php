<?php

namespace Controllers;

use Core\Controller;
use Models\UserModel;

class AuthController extends Controller {

    public function __construct() {
    }

    public function login() {
        if (isset($_SESSION['user'])) {
            $this->redirect('index.php?controller=user&action=index');
        }

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            if ($user && $user['password'] === $password) {
                $_SESSION['user'] = $user['username'];
                $this->redirect("index.php?controller=user&action=index");
            } else {
                $error = "Invalid username or password!";
            }
        }

        $this->view('auth/login', ['error' => $error]);
    }

    public function register() {
        if (isset($_SESSION['user'])) {
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = htmlspecialchars($_POST['fname']);
            $lname = htmlspecialchars($_POST['lname']);
            $address = htmlspecialchars($_POST['address']);
            $country = htmlspecialchars($_POST['country']);
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];
            $department = htmlspecialchars($_POST['department']);
            $user_code = $_POST['user_code'];
            $real_code = $_POST['real_code'];
            
            if ($user_code != $real_code) {
                die("<h3>Error: Verification code is incorrect!</h3><a href='index.php?controller=auth&action=register'>Go Back</a>");
            }
            
            $profile_pic = "";
            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
                $uploadDir = "uploads/";
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
            
                $fileExtension = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
                $newFileName = time() . "_" . uniqid() . "." . $fileExtension;     
                $targetFile = $uploadDir . $newFileName;
            
                $allowedTypes = ["jpg", "jpeg", "png"];
                if (in_array(strtolower($fileExtension), $allowedTypes)) {
                    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
                        $profile_pic = $targetFile;
                    } else {
                        die("Error uploading file.");
                    }
                } else {
                    die("Invalid file type.");
                }
            }

            $userModel = new UserModel();
            $success = $userModel->createUser([
                'fname' => $fname,
                'lname' => $lname,
                'address' => $address,
                'country' => $country,
                'gender' => $gender,
                'skills' => $skills,
                'username' => $username,
                'password' => $password,
                'department' => $department,
                'profile_pic' => $profile_pic
            ]);

            if ($success) {
                $this->redirect("index.php?controller=user&action=index");
            } else {
                die("Error Saving Data");
            }
        } else {
            $this->view('auth/register');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        $this->redirect("index.php?controller=auth&action=login");
    }

    public static function requireLogin() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }
}
