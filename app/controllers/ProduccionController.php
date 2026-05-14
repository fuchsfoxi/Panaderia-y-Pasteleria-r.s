<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Produccion.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Turno.php';

class ProduccionController extends Controller {
    
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
        $this->view('stock/stock', $datos);
    }

    public function crear(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $coches = (int)($_POST['cantidad_coches'] ?? 0);
            $latas  = (int)($_POST['cantidad_latas'] ?? 0);

            if ($coches === 0 && $latas === 0) {
                header("Location: " . BASE_URL . "/produccion/crear?error=1");
                exit();
            }

            $cantidad = $coches + $latas;

            $modelo = new Produccion();
            $modelo->insertar(
                $cantidad,
                (int)$_POST['id_producto'],
                (int)$_POST['id_turno']
            );
            header("Location: " . BASE_URL . "/produccion");
            exit();
        }

        $datos = [
            'productos' => (new Producto())->obtenerProductos(),
            'turnos'    => (new Turno())->obtenerTurnos(),
        ];
        $this->view('stock/stock_panes', $datos);
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

        $this->view('historial/historial', ['id' => $id]);
    }

    public function eliminar(int $id): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Produccion();
        $modelo->eliminar($id);
        header("Location: " . BASE_URL . "/produccion");
        exit();
    }
}