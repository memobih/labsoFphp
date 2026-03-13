<?php
session_start();

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function getLoggedInUser()
{
    return isLoggedIn() ? $_SESSION['user'] : null;
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}
?>