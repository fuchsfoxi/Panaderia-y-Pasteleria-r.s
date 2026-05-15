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
        $datos = [
            'productos' => (new Producto())->obtenerProductos(),
            'turnos'    => (new Turno())->obtenerTurnos(),
        ];
        $this->view('stock/stock', $datos);
    }
}