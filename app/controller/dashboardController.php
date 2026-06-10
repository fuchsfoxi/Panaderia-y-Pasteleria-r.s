<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController extends Controller {

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

        echo json_encode([
            'hoy' => $modelo->TotalesMapeados(),
            'ayer' => $modelo->TotalesMapeados(),
            'ultimo_turno' => $modelo->UltimoTurno()
        ]);

        exit();
    }

    public function index(): void {

        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit();
        }

        $this->view('dashboard/index');
    }
}