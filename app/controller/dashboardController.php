<?php

require_once __DIR__ ."/../core/controller.php";

class DashboardController extends Controller
{
    public function index():void{

        if(!isset($_SESSION['usuario'])){
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        $this->view("dashboard/index", ['usuario' => $_SESSION['usuario']]);
    }
}