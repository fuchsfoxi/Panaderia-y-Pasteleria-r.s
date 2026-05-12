<?php

require_once __DIR__ . '/../core/Database.php';

class Turno {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTurnos(): array {
        $sql = "SELECT id_turno, nombre_turno FROM turno";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}