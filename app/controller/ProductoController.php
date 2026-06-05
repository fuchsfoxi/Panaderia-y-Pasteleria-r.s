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
        $datos = [
            'productos'  => $modelo->obtenerProductos(),
            'rutaActual' => 'producto'
        ];
        $this->view('Ingresos_datos/New_producto', $datos);
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
    }

    public function editar(int $id): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = new Producto();
            $modelo->actualizar($id, trim($_POST['nombre']), (int)$_POST['id_tipo']);
        }
        // GET o POST: siempre vuelve a la lista
        header("Location: " . BASE_URL . "/producto");
        exit();
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