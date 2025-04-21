<?php
require_once "../core/Controller.php";
require '../services/TaskService.php';


class IndexController extends Controller
{
    public function index()
    {
        $TaskService = new TaskService();
        $users = $TaskService->getData(); // Llamas a la API

        // Obtén todos los usuarios (por ejemplo)
        $this->view('index', ['users' => $users]);
    }

    public function create()
    {
        // Carga la vista para crear un nuevo usuario
        // $this->view('create');
    }

    public function edit($id)
    {
        // Obtén los datos del usuario a editar
        // $this->view('edit', ['user' => $user]);
    }

    public function store($data)
    {
        // Aquí procesamos la creación de un nuevo usuario
        header("Location: /home"); // Redirige a la vista principal
    }

    public function update($id, $data)
    {
        // Aquí procesamos la actualización del usuario
        // $user = User::find($id);
        // $user->update($data);
        // header("Location: /home"); // Redirige a la vista principal
    }
}
