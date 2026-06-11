<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController extends Controller {

    public function index(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $this->view('dashboard/index', ['usuario' => $_SESSION['usuario']]);
    }

    /**
     * GET  /dashboard/datos    
     * Devuelve JSON con totales de hoy, ayer y último turno.
     * Lo consume dashboard.js para llenar las cards y el gráfico.
     */
    public function datos(): void {
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            echo json_encode([
                'error' => 'No autorizado'
            ]);
            exit();
        }

        header('Content-Type: application/json');

        $modelo = new Dashboard();

        // Convertir el array de filas en un mapa  tipo => total
        $mapear = function (array $filas): array {
            $mapa = ['PAN' => 0, 'BOCADITO' => 0, 'TORTA' => 0];
            foreach ($filas as $fila) {
                $mapa[$fila['tipo']] = (int) $fila['total'];
            }
            return $mapa;
        };

        echo json_encode([
            'hoy'          => $mapear($modelo->totalesPorDia('today')),
            'ayer'         => $mapear($modelo->totalesPorDia('yesterday')),
            'ultimo_turno' => $modelo->ultimoTurno(),
        ]);
        exit();
    }
}