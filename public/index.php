<?php
require_once "../app/core/Controller.php";
require_once "../app/core/Model.php";
require_once "../app/migrations/Migrations.php"; // Agregar esta línea para incluir las migraciones
require_once __DIR__ . '/../vendor/autoload.php';
// require_once __DIR__ . '/../app/Helpers/helpers.php';


// logger()->info('Este es un mensaje de log');
// logger()->error('Algo salió mal');


// Ejecutar las migraciones al iniciar el proyecto
runMigrations();

$url = $_GET['url'] ?? '';
$segments = explode('/', rtrim($url, '/'));

$isApi = $segments[0] === 'api';

if ($isApi) {
    $controllerName = ucfirst($segments[1]) . 'Controller';
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $segments[2] ?? null;

    require_once "../app/controllers/Api/$controllerName.php";
    $controller = new $controllerName();

    header('Content-Type: application/json');

    switch ($method) {
        case 'GET':
            if ($id) $controller->show($id);
            else $controller->index();
            break;
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->store($data);
            break;
        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->update($id, $data);
            break;
        case 'DELETE':
            $controller->destroy($id);
            break;
        default:
            http_response_code(405);
            echo json_encode(["message" => "Método no permitido"]);
    }

    exit;
}
