<?php
require_once "auth.php";
requireLogin();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id'];
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $country = trim($_POST['country']);
    $username = trim($_POST['username']);

    // Check if a new profile pic is uploaded
    $profile_pic_path = null;
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = __DIR__ . '/uploads';
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }
        $ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
        $newName = uniqid('pic_', true) . '.' . $ext;
        $dest = $uploadsDir . '/' . $newName;
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $dest)) {
            $profile_pic_path = 'uploads/' . $newName;
        }
    }

    if ($profile_pic_path) {
        $sql = "UPDATE users SET fname=?, lname=?, country=?, username=?, profile_pic=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $fname, $lname, $country, $username, $profile_pic_path, $id);
    } else {
        $sql = "UPDATE users SET fname=?, lname=?, country=?, username=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $fname, $lname, $country, $username, $id);
    }

    mysqli_stmt_execute($stmt);
}

header("Location: list.php");
exit;