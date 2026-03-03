<?php

$data = json_decode(file_get_contents("data.json"), true);

$id = $_POST['id'];

$data[$id]['fname'] = $_POST['fname'];
$data[$id]['lname'] = $_POST['lname'];
$data[$id]['address'] = $_POST['address'];
$data[$id]['country'] = $_POST['country'];
$data[$id]['username'] = $_POST['username'];

file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

header("Location: list.php");
exit;