<?php

namespace Core;

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        $viewFile = "Views/" . $view . ".php";
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View $viewFile not found.");
        }
    }
    
    protected function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}
