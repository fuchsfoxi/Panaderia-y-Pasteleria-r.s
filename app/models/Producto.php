<?php
require_once __DIR__ . '/../core/Database.php';

class Producto {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function ObtenerProductos(): array {
        $sql = "SELECT 
                    producto.id_producto,
                    producto.nombre_prod,
                    producto.id_tipo,
                    tipo.tipo
                FROM producto
                JOIN tipo ON producto.id_tipo = tipo.id_tipo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ObtenerProductosPorTipo(string $tipo): array {
        $sql = "SELECT 
                    producto.id_producto,
                    producto.nombre_prod
                FROM producto
                JOIN tipo ON producto.id_tipo = tipo.id_tipo
                WHERE tipo.tipo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tipo]);
        return $stmt->fetchAll();
    }

    public function Insertar(string $nombre, int $id_tipo): bool {
        $sql = "INSERT INTO producto (nombre_prod, id_tipo) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $id_tipo]);
    }

    public function Actualizar(int $id, string $nombre, int $id_tipo): bool {
        $sql = "UPDATE producto SET nombre_prod = ?, id_tipo = ? WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $id_tipo, $id]);
    }

public function Eliminar(int $id): bool {

    $sql1 = "DELETE FROM produccion WHERE id_producto = ?";
    $stmt1 = $this->db->prepare($sql1);
    $stmt1->execute([$id]);

    $sql2 = "DELETE FROM producto WHERE id_producto = ?";
    $stmt2 = $this->db->prepare($sql2);
    return $stmt2->execute([$id]);
}
}