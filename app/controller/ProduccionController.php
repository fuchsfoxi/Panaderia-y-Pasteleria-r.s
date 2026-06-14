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
            $id_turno = (int)($_POST['id_turno'] ?? 0);
            $productos = $_POST['productos'] ?? [];

            if ($id_turno === 0 || empty($productos)) {
                header("Location: " . BASE_URL . "/produccion/crear?error=1");
                exit();
            }

            $modelo = new Produccion();

            foreach ($productos as $id_producto => $cantidad) {
                $cantidad = (int)$cantidad;
                if ($cantidad > 0) {
                    $modelo->insertar($id_turno, (int)$id_producto, $cantidad, null);
                }
            }

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
            $id_turno = (int)($_POST['id_turno'] ?? 0);
            $id_producto = (int)($_POST['id_producto'] ?? 0);
            $cantidad = (int)($_POST['cantidad'] ?? 0);
            $hora_agotada = !empty($_POST['hora_agotada']) ? $_POST['hora_agotada'] : null;

            if ($id_turno === 0 || $id_producto === 0 || $cantidad === 0) {
                header("Location: " . BASE_URL . "/historial?error=1");
                exit();
            }

            $modelo = new Produccion();
            $modelo->actualizar($id, $id_turno, $id_producto, $cantidad, $hora_agotada);
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