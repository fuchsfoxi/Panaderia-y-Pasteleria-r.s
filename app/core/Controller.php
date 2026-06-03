<?php

class controller{
    protected function view(string $vista, array $datos = []): void{
        extract($datos);
        require_once __DIR__ . "/../views/$vista.php";
    }
}