<?php

class Router{

public function run():void {
    $url = $_GET["url"] ?? '';

    $url = filter_var(trim($url, '/'), FILTER_SANITIZE_URL);

    $partes = explode ('/', $url);

    $nombreController = !empty($partes[0])
    ? ucfirst(strtolower($partes[0])) . "Controller"
    : "HomeController";

    $metodo = !empty($partes[1]) ? $partes[1] : "index";

    $sparams = array_slice($partes, 2);

    $archivo = __DIR__ . '../controllers/' . $nombreController . '.php';

}
}