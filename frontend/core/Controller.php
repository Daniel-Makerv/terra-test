<?php
class Controller
{
    // Cargar la vista
    public function view($view, $data = [])
    {
        extract($data);
        require_once "../views/{$view}.php";
    }
}
