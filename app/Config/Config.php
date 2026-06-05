<?php

define("TITLE_BUSINESS", "PANADERIA Y PASTELERIA R.S");

//leer el archivo .env que esta en la raiz del proyecto
$envFile = dirname(__DIR__ ) . '/.env';
if (file_exists($envFile)) {
    // Recorremos cada linea del archivo .env omitiendo saltos y lineas vacias
    foreach(file ($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line){
        if (str_starts_with($line, '#'))continue;
        [$key, $value] = explode("=" , $line,2);    
        $_ENV[trim($key)] = trim($value);
    }
}


define("DB_HOST", $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost');
define("DB_PORT", $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? '3306');
define("DB_USER", $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME') ?? 'root');
define("DB_NAME", $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE') ?? 'panaderia_rs');
define("DB_PASSWORD", $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '');
define("BASE_URL", $_ENV['APP_URL'] ?? getenv('APP_URL') ?? 'http://localhost/Panaderia-y-Pasteleria-r.s');