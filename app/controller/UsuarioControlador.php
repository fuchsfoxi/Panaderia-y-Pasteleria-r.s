<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioControlador extends Controller {

    public function index(): void {

        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Usuario();

        $datos = [
            'usuarios' => $modelo->ListarUsuarios()
        ];

        $this->view('usuario/index', $datos);
    }

    public function crear(): void {

        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre_usuario = trim($_POST['nombre_usuario']);
            $clave = trim($_POST['clave']);
            $id_rol = (int)$_POST['id_rol'];
            $id_empleado = !empty($_POST['id_empleado'])
                ? (int)$_POST['id_empleado']
                : null;

            $modelo = new Usuario();

            $modelo->InsertarUsuario(
                $nombre_usuario,
                $clave,
                $id_rol,
                $id_empleado
            );

            header("Location: " . BASE_URL . "/usuario");
            exit();
        }

        $this->view('usuario/crear');
    }
}