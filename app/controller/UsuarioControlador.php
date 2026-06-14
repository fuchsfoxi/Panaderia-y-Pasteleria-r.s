<?php
require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioControlador extends Controller {

    public function index(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        // El modelo Usuario no tiene ListarUsuarios(), necesitas agregarlo
        // o cambiar la lógica. Por ahora, mostramos vista vacía o redirigimos.
        $this->view('usuario/index', ['usuarios' => []]);
    }

    public function crear(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
            $clave = trim($_POST['clave'] ?? '');
            $roles = $_POST['roles'] ?? 'admin';

            if (empty($nombre_usuario) || empty($clave)) {
                header("Location: " . BASE_URL . "/usuario/crear?error=1");
                exit();
            }

            $modelo = new Usuario();
            $modelo->insertar($roles, $nombre_usuario, $clave);
            header("Location: " . BASE_URL . "/usuario");
            exit();
        }

        $this->view('usuario/crear');
    }
}