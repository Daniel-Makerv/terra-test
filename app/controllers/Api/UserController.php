<?php
class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {
        echo json_encode($this->userModel->getAll());
    }

    public function show($id) {
        $user = $this->userModel->getById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Usuario no encontrado"]);
        }
    }

    public function store($data) {
        if (isset($data['name'], $data['email'])) {
            $this->userModel->create($data['name'], $data['email']);
            http_response_code(201);
            echo json_encode(["message" => "Usuario creado"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function update($id, $data) {
        if (isset($data['name'], $data['email'])) {
            $this->userModel->update($id, $data['name'], $data['email']);
            echo json_encode(["message" => "Usuario actualizado"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function destroy($id) {
        $this->userModel->delete($id);
        echo json_encode(["message" => "Usuario eliminado"]);
    }
}
?>