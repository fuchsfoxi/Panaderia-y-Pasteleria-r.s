<?php
require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller {
    
    public function index(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $this->view("dashboard/index");
    }

    public function landing(): void {
        $this->view("home/landing");
    }
}