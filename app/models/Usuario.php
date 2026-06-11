<?php

require_once __DIR__ . '/../core/Database.php';

class Usuario {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function buscarPorNombre(string $nombre_usuario): array|false {
        $sql = "SELECT * FROM usuario WHERE nombre_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nombre_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar(string $roles, string $nombre_usuario, string $clave): bool {
        $sql = "INSERT INTO usuario (roles, nombre_usuario, clave) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        $hash = password_hash($clave, PASSWORD_DEFAULT);

        return $stmt->execute([$roles, $nombre_usuario, $hash]);
    }
}