<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require '../controllers/IndexController.php';
$controller = new IndexController();

echo $uri;
switch ($uri) {
    case '/':
        $controller->index();
        break;

    case '/task/create':
        $controller->create();
        break;

        

    default:
        echo "404 - Página no encontrada". $uri;
        break;
}
