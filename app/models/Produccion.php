<?php

require_once __DIR__ . '/../core/Database.php'; 

class Produccion{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerProduccion(){
        $sql = "SELECT * FROM produccion";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}