<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Produccion.php';

class EmpleadosController extends Controller {
    
    public function index(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Produccion();
        $datos = [
            'panes'     => $modelo->obtenerProduccion('Pan'),
            'bocaditos' => $modelo->obtenerProduccion('Bocadito'),
            'tortas'    => $modelo->obtenerProduccion('Torta'),
        ];
        $this->view('produccion/index', $datos);
    }



    public function crear(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Produccion();
            $modelo->insertar(
                (int)$_POST['cantidad'],
                (int)$_POST['id_producto'],
                (int)$_POST['id_turno']
            );
            header("Location: " . BASE_URL . "/produccion");
            exit();
        }
    }

    public function editar(int $id): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Produccion();
            $modelo->actualizar(
                $id,
                (int)$_POST['cantidad'],
                (int)$_POST['id_producto'],
                (int)$_POST['id_turno']
            );
            header("Location: " . BASE_URL . "/produccion");
            exit();
        }
    }

    public function eliminar(int $id): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Produccion();
        $metodoEliminar = 'eliminar';
        if (!method_exists($modelo, $metodoEliminar) && method_exists($modelo, 'eliminarProduccion')) {
            $metodoEliminar = 'eliminarProduccion';
        }
        if (method_exists($modelo, $metodoEliminar)) {
            $modelo->{$metodoEliminar}($id);
        }

        header("Location: " . BASE_URL . "/produccion");
        exit();
    }
}