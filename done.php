<?php

function redirect($url){
    header("Location: $url");
    exit;
}

if($_SERVER["REQUEST_METHOD"] != "POST"){
    redirect("registration.php");
}

$data = json_decode(file_get_contents("data.json"), true);

$newUser = [
    "fname"     => $_POST['fname'] ?? '',
    "lname"     => $_POST['lname'] ?? '',
    "address"   => $_POST['address'] ?? '',
    "country"   => $_POST['country'] ?? '',
    "gender"    => $_POST['gender'] ?? '',
    "skills"    => $_POST['skills'] ?? [],
    "username"  => $_POST['username'] ?? '',
    "department"=> $_POST['department'] ?? ''
];

$data[] = $newUser;

file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

redirect("list.php");