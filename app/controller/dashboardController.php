<?php

require_once __DIR__ . '/../core/controller.php';
require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController extends Controller {

    public function datos(): void
    {
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No autorizado']);
            exit();
        }

        header('Content-Type: application/json');

        $modelo = new Dashboard();

        echo json_encode([
            'hoy' => $modelo->totalesMapeados('today'),
            'ayer' => $modelo->totalesMapeados('yesterday'),
            'ultimo_turno' => $modelo->ultimoTurno(),
        ]);

        exit();
    }
}