<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Historial.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Turno.php';

class HistorialController extends Controller {

public function index(): void {
    if (!isset($_SESSION['usuario'])) {
        header("Location: " . BASE_URL . "/login");
        exit();
    }

    $tipo  = $_GET['tipo'] ?? null;
    $fecha = $_GET['fecha'] ?? null;

    $modelo = new Historial();
    $datos  = [
        'registros' => $modelo->obtenerTodo($tipo, $fecha),
        'productos' => (new Producto())->obtenerProductos(),
        'turnos'    => (new Turno())->obtenerTurnos(),
    ];
    $this->view('historial/historial', $datos);
}
    
}