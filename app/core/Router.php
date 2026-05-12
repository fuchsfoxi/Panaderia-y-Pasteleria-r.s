<?php

class Router{

public function run():void {
    $url = $_GET["url"] ?? '';

    $url = filter_var(trim($url, '/'), FILTER_SANITIZE_URL);

    $partes = explode ('/', $url);

    $nombreController = !empty($partes[0])
    
}
}