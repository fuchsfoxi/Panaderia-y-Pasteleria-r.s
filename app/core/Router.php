<?php

class Router{

public function run(): void {
    $url = $_GET["url"] ?? '';

    $url = filter_var(trim($url, '/'), FILTER_SANITIZE_URL);

    $partes = explode('/', $url);

    $nombreController = !empty($partes[0])
        ? ucfirst(strtolower($partes[0])) . "Controller"
        : "HomeController";

    $metodo = !empty($partes[1]) ? $partes[1] : "index";

    $params = array_slice($partes, 2);

    $archivo = __DIR__ . '/../controllers/' . $nombreController . '.php'; 

    if (!file_exists($archivo)) {
        $this->abortar(404);
        return;
    }

    require_once $archivo; 

    if (!class_exists($nombreController)) { 
        $this->abortar(404);
        return;
    }

    $controller = new $nombreController(); 

    if (!method_exists($controller, $metodo)) {
        $this->abortar(404);
        return;
    }

    $controller->$metodo(...$params); 
}

private function abortar(int $codigo): void { 
    http_response_code($codigo);
    echo "<h1>Error $codigo - Página no encontrada</h1>";
}

}