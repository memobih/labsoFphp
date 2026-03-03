<?php
include "db.php";

if($_SERVER["REQUEST_METHOD"] != "POST"){
    header("Location: registration.php");
    exit;
}

$fname      = $_POST['fname'];
$lname      = $_POST['lname'];
$address    = $_POST['address'];
$country    = $_POST['country'];
$gender     = $_POST['gender'];
$skills     = isset($_POST['skills']) ? implode(",", $_POST['skills']) : "";
$username   = $_POST['username'];
$department = $_POST['department'];

$sql = "INSERT INTO users 
(fname, lname, address, country, gender, skills, username, department)
VALUES
('$fname', '$lname', '$address', '$country', '$gender', '$skills', '$username', '$department')";

mysqli_query($conn, $sql);

header("Location: list.php");
exit;