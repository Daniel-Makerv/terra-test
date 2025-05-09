<?php
require_once "../core/Controller.php";
require_once "../core/Model.php";
require_once "../migrations/Migrations.php"; // Agregar esta línea para incluir las migraciones
require_once __DIR__ . '/../../vendor/autoload.php';
// require_once __DIR__ . '/../app/Helpers/helpers.php';


// logger()->info('Este es un mensaje de log');
// logger()->error('Algo salió mal');


// Encabezados CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

header('Content-Type: application/json'); // Obtener método

// Obtener método
$method = $_SERVER['REQUEST_METHOD'];

// Ruta solicitada
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = trim($path, '/');
$segments = explode('/', rtrim($path, '/'));

$isApi = $segments[0] === 'api';


// Verificar solicitud OPTIONS (Preflight Request)
if($method == "OPTIONS") {
    die();
}


if ($isApi) {
    $controllerName = ucfirst($segments[1]) . 'Controller';
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $segments[2] ?? null;

    $controllerFile = "../controllers/Api/$controllerName.php";


    if (!file_exists($controllerFile)) { //404 controller no encontrado
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



    // Obtener método
    $method = $_SERVER['REQUEST_METHOD'];

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
