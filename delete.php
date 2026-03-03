<?php
$data = json_decode(file_get_contents("data.json"), true);

$id = $_GET['id'];
unset($data[$id]);
$data = array_values($data);

file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));

header("Location: list.php");
exit;