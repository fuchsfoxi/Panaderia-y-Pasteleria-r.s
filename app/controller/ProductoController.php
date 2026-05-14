<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Producto.php';

class ProductoController extends Controller {

    public function index(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $modelo = new Producto();
        $datos = ['productos' => $modelo->obtenerProductos()];
        $this->view('producto/index', $datos);
    } 

    public function crear(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Producto();
            $modelo->insertar(trim($_POST['nombre']), (int)$_POST['id_tipo']);
            header("Location: " . BASE_URL . "/producto");
            exit();
        }
        $this->view('producto/crear');
    } // ← cierra crear

    public function editar(int $id): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Producto();
            $modelo->actualizar($id, trim($_POST['nombre']), (int)$_POST['id_tipo']);
            header("Location: " . BASE_URL . "/producto");
            exit();
        }
        $this->view('producto/editar', ['id' => $id]);
    }

    public function eliminar(int $id): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $modelo = new Producto();
        $modelo->eliminar($id);
        header("Location: " . BASE_URL . "/producto");
        exit();
    }
}