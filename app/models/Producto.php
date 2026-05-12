<?php
require_once __DIR__ . '/../core/Database.php';

class Producto {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerProductos(): array {
        $sql = "SELECT 
                    producto.id_producto,
                    producto.nombre_prod,
                    tipo.tipo
                FROM producto
                JOIN tipo ON producto.id_tipo = tipo.id_tipo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertar(string $nombre, int $id_tipo): bool {
        $sql = "INSERT INTO producto (nombre_prod, id_tipo) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $id_tipo]);
    }

    public function actualizar(int $id, string $nombre, int $id_tipo): bool {
        $sql = "UPDATE producto SET nombre_prod = ?, id_tipo = ? WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $id_tipo, $id]);
    }

    public function eliminar(int $id): bool {
        $sql = "DELETE FROM producto WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}