<?php

require_once __DIR__ . '/../core/Database.php';

class Stock {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function ObtenerStock(): array {
        $sql = "SELECT
                    s.id_stock,
                    p.nombre_producto,
                    s.cantidad_actual
                FROM stock s
                JOIN producto p ON s.id_producto = p.id_producto
                ORDER BY s.id_stock DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function Insertar(
        int $id_producto,
        int $cantidad_actual
    ): bool {

        $sql = "INSERT INTO stock
                (id_producto, cantidad_actual)
                VALUES (?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $id_producto,
            $cantidad_actual
        ]);
    }

    public function Actualizar(
        int $id_stock,
        int $id_producto,
        int $cantidad_actual
    ): bool {

        $sql = "UPDATE stock
                SET id_producto = ?,
                    cantidad_actual = ?
                WHERE id_stock = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $id_producto,
            $cantidad_actual,
            $id_stock
        ]);
    }

    public function Eliminar(int $id): bool {
        $sql = "DELETE FROM stock
                WHERE id_stock = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function ObtenerPorNombreProducto(string $nombre_producto): array {
        $sql = "SELECT
                    s.id_stock,
                    p.nombre_producto,
                    s.cantidad_actual
                FROM stock s
                JOIN producto p ON s.id_producto = p.id_producto
                WHERE p.nombre_producto LIKE ?
                ORDER BY s.id_stock DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["%$nombre_producto%"]);

        return $stmt->fetchAll();
    }
}