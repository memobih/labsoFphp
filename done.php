<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: registration.php");
    exit;
}

$fname = trim($_POST['fname'] ?? '');
$lname = trim($_POST['lname'] ?? '');
$address = trim($_POST['address'] ?? '');
$country = trim($_POST['country'] ?? '');
$gender = trim($_POST['gender'] ?? '');
$skillsArr = $_POST['skills'] ?? [];
$skills = implode(",", $skillsArr);
$username = trim($_POST['username'] ?? '');
$department = trim($_POST['department'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];
$required = ['fname', 'lname', 'address', 'country', 'gender', 'username', 'password'];
foreach ($required as $field) {
    if (empty($$field)) {
        $errors[] = ucfirst($field) . ' is required.';
    }
}
if (!preg_match('/^[A-Za-z]+$/', $fname)) {
    $errors[] = 'First name must contain only letters.';
}
if (!preg_match('/^[A-Za-z]+$/', $lname)) {
    $errors[] = 'Last name must contain only letters.';
}
if (count($skillsArr) == 0) {
    $errors[] = 'At least one skill must be selected.';
}
if (!preg_match('/^[a-z0-9_]{8}$/', $password)) {
    $errors[] = 'Password must be exactly 8 characters, lowercase letters, numbers, or underscore.';
}
$profile_pic_path = null;
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $allowedMime = ['image/jpeg', 'image/png'];
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($fileInfo, $_FILES['profile_pic']['tmp_name']);
    if (!in_array($mime, $allowedMime)) {
        $errors[] = 'Profile picture must be JPG or PNG.';
    }
    if ($_FILES['profile_pic']['size'] > 2097152) {
        $errors[] = 'Profile picture must be less than 2MB.';
    }
    if (empty($errors)) {
        $uploadsDir = __DIR__ . '/uploads';
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }
        $ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
        $newName = uniqid('pic_', true) . '.' . $ext;
        $dest = $uploadsDir . '/' . $newName;
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $dest)) {
            $profile_pic_path = 'uploads/' . $newName;
        } else {
            $errors[] = 'Failed to move uploaded file.';
        }
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: registration.php');
    exit;
}


$sql = "INSERT INTO users (fname, lname, address, country, gender, skills, username, password, department, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ssssssssss', $fname, $lname, $address, $country, $gender, $skills, $username, $password, $department, $profile_pic_path);

if (!mysqli_stmt_execute($stmt)) {
    $_SESSION['errors'] = ['Database error: ' . mysqli_error($conn)];
    header('Location: registration.php');
    exit;
}

header("Location: list.php");
exit;