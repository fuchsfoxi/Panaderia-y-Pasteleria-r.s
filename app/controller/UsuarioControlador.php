<?php

require_once __DIR__ ."/../core/controller.php";
require_once __DIR__ ."/../models/Usuario.php";

class UsuarioControlador extends Controller {

    public function index(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $modelo = new Usuario();
        $datos = ['usuarios' => $modelo->buscarPorNombre($_SESSION['usuario']['nombre_usuario'])];
        $this->view('usuario/index', $datos);
    } 

    public function crear(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Usuario();
            $id_rol = (int)($_POST['id_rol'] ?? 1);
            $id_empleado = !empty($_POST['id_empleado']) ? (int)$_POST['id_empleado'] : null;
            $modelo->insertar($id_rol, trim($_POST['nombre_usuario']), trim($_POST['clave']), $id_empleado);
            header("Location: " . BASE_URL . "/usuario");
            exit();
        }
        $this->view('usuario/crear');
    }// ← cierra crear
}