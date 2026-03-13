<?php

namespace Controllers;

use Core\Controller;
use Models\UserModel;

class UserController extends Controller {

    public function __construct() {
        AuthController::requireLogin();
    }

    public function index() {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        
        $this->view('users/list', [
            'users' => $users,
            'loggedInUser' => $_SESSION['user']
        ]);
    }

    public function show() {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        
        if ($id <= 0) {
            die("Invalid user ID.");
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if (!$user) {
            die("User not found.");
        }

        $this->view('users/view', [
            'user' => $user,
            'loggedInUser' => $_SESSION['user']
        ]);
    }

    public function edit() {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        
        if ($id <= 0) {
            die("Invalid ID.");
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if (!$user) {
            die("User not found.");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = htmlspecialchars($_POST['fname']);
            $lname = htmlspecialchars($_POST['lname']);
            $address = htmlspecialchars($_POST['address']);
            $country = htmlspecialchars($_POST['country']);
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';
            $username = htmlspecialchars($_POST['username']);
            $department = htmlspecialchars($_POST['department']);
            $password = $_POST['password'];

            $profile_pic = '';
            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileExtension = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
                $newFileName = time() . "_" . uniqid() . "." . $fileExtension;     
                $targetFile = $uploadDir . $newFileName;

                $allowedTypes = ["jpg", "jpeg", "png", "gif"];
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

            $success = $userModel->updateUser($id, [
                'fname' => $fname,
                'lname' => $lname,
                'address' => $address,
                'country' => $country,
                'gender' => $gender,
                'skills' => $skills,
                'username' => $username,
                'department' => $department,
                'password' => $password,
                'profile_pic' => $profile_pic
            ]);

            if ($success) {
                $this->redirect("index.php?controller=user&action=index");
            } else {
                die("Error saving data.");
            }
        } else {
            $this->view('users/edit', [
                'user' => $user,
                'loggedInUser' => $_SESSION['user']
            ]);
        }
    }

    public function delete() {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        
        if ($id <= 0) {
            $this->redirect("index.php?controller=user&action=index");
        }

        $userModel = new UserModel();
        $userModel->deleteUser($id);

        $this->redirect("index.php?controller=user&action=index");
    }
}
