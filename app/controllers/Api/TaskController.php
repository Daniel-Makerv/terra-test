<?php
class TaskController  extends Controller
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = $this->model('Task');
    }

    public function index()
    {
        echo json_encode($this->taskModel->getAll());
    }

    public function show($id)
    {
        $user = $this->taskModel->getById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Tarea no encontrado"]);
        }
    }

    public function store($data)
    {
        if (isset($data['task_name'])) {
            $this->taskModel->create($data['task_name']);
            http_response_code(201);
            echo json_encode(["message" => "Tarea creada correctamente"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function update($id, $data)
    {
        if (isset($data['task_name'])) {
            $this->taskModel->update($id, $data['task_name']);
            echo json_encode(["message" => "Tarea actualizado"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function destroy($id)
    {
        $this->taskModel->delete($id);
        echo json_encode(["message" => "Tarea eliminado"]);
    }
}
