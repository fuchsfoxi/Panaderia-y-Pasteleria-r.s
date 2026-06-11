<?php
require_once __DIR__ . '/../core/Database.php';

class Producto {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function ObtenerProductos(): array {
        $sql = "SELECT 
                    p.id_producto,
                    p.nombre_prod,
                    t.tipo
                FROM producto p
                JOIN tipo t ON p.id_tipo = t.id_tipo
                ORDER BY p.nombre_prod";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ObtenerProductosPorTipo(string $tipo): array {
        $sql = "SELECT 
                    p.id_producto,
                    p.nombre_prod,
                    t.tipo
                FROM producto p
                JOIN tipo t ON p.id_tipo = t.id_tipo
                WHERE t.tipo = ?
                ORDER BY p.nombre_prod";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Insertar(string $nombre, int $id_tipo): bool {
        $sql = "INSERT INTO producto (nombre_prod, id_tipo) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $id_tipo]);
    }

    public function actualizar(int $id, string $nombre, int $id_tipo): bool {
        $sql = "UPDATE producto 
                SET nombre_prod = ?, id_tipo = ? 
                WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $id_tipo, $id]);
    }

    public function eliminar(int $id): bool {

        // SOLO si existen relaciones reales en tu BD
        // (si no tienes estas tablas, bórralas)

        /*
        $sql1 = "DELETE FROM detalle_produccion WHERE id_producto = ?";
        $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute([$id]);

        $sql2 = "DELETE FROM stock WHERE id_producto = ?";
        $stmt2 = $this->db->prepare($sql2);
        $stmt2->execute([$id]);
        */

        $sql = "DELETE FROM producto WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}