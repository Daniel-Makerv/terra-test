<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
        require '../controllers/IndexController.php';
        $controller = new IndexController();
        $controller->index();
        break;
    
    default:
        echo "404 - Página no encontrada";
        break;
}
