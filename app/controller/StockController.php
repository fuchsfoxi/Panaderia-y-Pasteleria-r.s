<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Produccion.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Turno.php';

class StockController extends Controller {

    public function index(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $this->view('stock/stock');
    }
    

    public function panes(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
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

    public function bocaditos(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $modelo = new Produccion();
        $datos = [
            'productos' => (new Producto())->obtenerProductosPorTipo('BOCADITO'),
            'turnos'    => (new Turno())->obtenerTurnos(),
            'bocaditos' => $modelo->obtenerProduccion('BOCADITO'),
        ];
        $this->view('stock/stock_bocaditos', $datos);
    }

    public function tortas(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $modelo = new Produccion();
        $datos = [
            'productos' => (new Producto())->obtenerProductosPorTipo('TORTA'),
            'turnos'    => (new Turno())->obtenerTurnos(),
            'tortas'    => $modelo->obtenerProduccion('TORTA'),
        ];
        $this->view('stock/stock_tortas', $datos);
    }

public function guardar(): void {
    if (!isset($_SESSION['usuario'])) {
        header("Location: " . BASE_URL . "/login");
        exit();
    }

    $id_turno     = (int)($_POST['id_turno'] ?? 0);
    $id_empleado  = (int)($_POST['id_empleado'] ?? 0);
    $id_producto  = (int)($_POST['id_producto'] ?? 0);
    $cantidad     = (int)($_POST['cantidad'] ?? 0);
    $tipo         = $_POST['tipo'] ?? 'PAN';

    $rutas = [
        'PAN'      => 'panes',
        'BOCADITO' => 'bocaditos',
        'TORTA'    => 'tortas',
    ];

    $ruta = $rutas[$tipo] ?? 'panes';

    if ($cantidad === 0 || $id_turno === 0 || $id_empleado === 0 || $id_producto === 0) {
        header("Location: " . BASE_URL . "/stock/" . $ruta . "?error=1");
        exit();
    }

    $modelo = new Produccion();
    $modelo->insertar($id_turno, $id_empleado, [
        ['id_producto' => $id_producto, 'cantidad' => $cantidad]
    ]);

    header("Location: " . BASE_URL . "/stock/" . $ruta);
    exit();
}
}