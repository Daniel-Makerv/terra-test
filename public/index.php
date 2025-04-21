<?php
require_once "../app/core/Controller.php";
require_once "../app/core/Model.php";
require_once "../app/migrations/Migrations.php"; // Agregar esta línea para incluir las migraciones
require_once __DIR__ . '/../vendor/autoload.php';
// require_once __DIR__ . '/../app/Helpers/helpers.php';


// logger()->info('Este es un mensaje de log');
// logger()->error('Algo salió mal');

header('Content-Type: application/json');
// Obtener método
$method = $_SERVER['REQUEST_METHOD'];

// Ruta solicitada
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = trim($path, '/');


$url = $_GET['url'] ?? '';
$segments = explode('/', rtrim($path, '/'));

$isApi = $segments[0] === 'api';


if ($isApi) {
    $controllerName = ucfirst($segments[1]) . 'Controller';
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $segments[2] ?? null;

    $controllerFile = "../app/controllers/Api/$controllerName.php";


    if (!file_exists($controllerFile)) {//404 controller no encontrado
        http_response_code(404);
        echo json_encode(["code" => 404, "message" => "Este endpoint no existe", "data" => null]);
        exit;
    }

    require_once $controllerFile;

    if (!class_exists($controllerName)) {
        echo json_encode(["code" => 500, "message" => "El controlador '$controllerName' no se pudo cargar correctamente", "data" => null]);
        exit;
    }


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
} else {
    runMigrations();
}
