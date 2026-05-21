<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Produccion.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Turno.php';

class ProduccionController extends Controller {

    public function crear(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cantidad = (int)($_POST['cantidad'] ?? 0);

            if ($cantidad === 0) {
                header("Location: " . BASE_URL . "/produccion/crear?error=1");
                exit();
            }

            $modelo = new Produccion();
            $modelo->insertar(
                $cantidad,
                (int)$_POST['id_producto'],
                (int)$_POST['id_turno']
            );
            header("Location: " . BASE_URL . "/produccion/crear");
            exit();
        }

        $modelo = new Produccion();
        $datos = [
            'productos' => (new Producto())->obtenerProductosPorTipo('Pan'),
            'turnos'    => (new Turno())->obtenerTurnos(),
            'panes'     => $modelo->obtenerProduccion('Pan'),
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
            header("Location: " . BASE_URL . "/historial");
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
        header("Location: " . BASE_URL . "/historial");
        exit();
    }
}