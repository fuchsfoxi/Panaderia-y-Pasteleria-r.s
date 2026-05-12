<?php
class Database{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO{
        if(self::$connection === null){
            $dns = "mysql:host=" . DB_HOST . ";port=" . DB_PORT. ";dbname=" . DB_NAME . ";charset=utf8mb4";
            self::$connection = new PDO($dns, DB_USER, DB_PASS, [

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
    }
    return self::$connection;
    }
}