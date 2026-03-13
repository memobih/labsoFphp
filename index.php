<?php
session_start();

spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$actionName = isset($_GET['action']) ? $_GET['action'] : ($controllerName === 'auth' ? 'login' : 'index');

$controllerClass = "Controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        die("Method $actionName not found in controller $controllerClass.");
    }
} else {
    die("Controller $controllerClass not found.");
}
