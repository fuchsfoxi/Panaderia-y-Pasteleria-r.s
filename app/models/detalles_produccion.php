<?php

require_once __DIR__ . '/../core/Database.php';

class DetalleProduccion {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function ObtenerDetallesProduccion(): array {

        $sql = "SELECT
                    dp.id_detalle,
                    p.fecha_produccion,
                    t.nombre_turno,
                    e.nombres,
                    e.apellidos,
                    pr.nombre_producto,
                    dp.cantidad
                FROM detalle_produccion dp
                JOIN produccion p
                    ON dp.id_produccion = p.id_produccion
                JOIN turno t
                    ON p.id_turno = t.id_turno
                JOIN empleado e
                    ON p.id_empleado = e.id_empleado
                JOIN producto pr
                    ON dp.id_producto = pr.id_producto
                ORDER BY dp.id_detalle DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ObtenerPorId(int $id): array|false {

        $sql = "SELECT *
                FROM detalle_produccion
                WHERE id_detalle = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Insertar(
        int $id_produccion,
        int $id_producto,
        int $cantidad
    ): bool {

        $sql = "INSERT INTO detalle_produccion
                (id_produccion, id_producto, cantidad)
                VALUES (?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $id_produccion,
            $id_producto,
            $cantidad
        ]);
    }

    public function Actualizar(
        int $id_detalle,
        int $id_produccion,
        int $id_producto,
        int $cantidad
    ): bool {

        $sql = "UPDATE detalle_produccion
                SET id_produccion = ?,
                    id_producto = ?,
                    cantidad = ?
                WHERE id_detalle = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $id_produccion,
            $id_producto,
            $cantidad,
            $id_detalle
        ]);
    }

    public function Eliminar(int $id): bool {

        $sql = "DELETE FROM detalle_produccion
                WHERE id_detalle = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }
}