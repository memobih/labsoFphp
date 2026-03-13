<?php
require_once "auth.php";
requireLogin();
include "db.php";

$id = (int) $_GET['id'];

$sql = "DELETE FROM users WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: list.php");
exit;