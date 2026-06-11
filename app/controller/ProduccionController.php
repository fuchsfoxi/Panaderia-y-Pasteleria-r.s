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
            $id_empleado = (int)($_POST['id_empleado'] ?? 0);
            $productos = $_POST['productos'] ?? [];

            if ($id_turno === 0 || $id_empleado === 0 || empty($productos)) {
                header("Location: " . BASE_URL . "/produccion/crear?error=1");
                exit();
            }

            $productos_formateados = [];
            foreach ($productos as $id_producto => $cantidad) {
                if ((int)$cantidad > 0) {
                    $productos_formateados[] = [
                        'id_producto' => (int)$id_producto,
                        'cantidad' => (int)$cantidad
                    ];
                }
            }

            if (empty($productos_formateados)) {
                header("Location: " . BASE_URL . "/produccion/crear?error=1");
                exit();
            }

            $modelo = new Produccion();
            $modelo->insertar($id_turno, $id_empleado, $productos_formateados);
            header("Location: " . BASE_URL . "/produccion/crear");
            exit();
        }

        $modelo = new Produccion();
        $datos = [
            'productos' => (new Producto())->obtenerProductosPorTipo('PAN'),
            'turnos'    => (new Turno())->obtenerTurnos(),
            'panes'     => $modelo->obtenerProduccion('PAN'),
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
            $id_empleado = (int)($_POST['id_empleado'] ?? 0);
            $productos = $_POST['productos'] ?? [];

            $productos_formateados = [];
            foreach ($productos as $id_producto => $cantidad) {
                if ((int)$cantidad > 0) {
                    $productos_formateados[] = [
                        'id_producto' => (int)$id_producto,
                        'cantidad' => (int)$cantidad
                    ];
                }
            }

            $modelo = new Produccion();
            $modelo->actualizar($id, $id_turno, $id_empleado, $productos_formateados);
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