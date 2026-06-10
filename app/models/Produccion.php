<?php

require_once __DIR__ . '/../core/Database.php';

class Produccion {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function ObtenerProduccion(): array {
        $sql = "SELECT
                    p.id_produccion,
                    p.fecha_produccion,
                    t.nombre_turno,
                    e.nombre_emp,
                    e.apellido_emp
                FROM produccion p
                JOIN turno t ON p.id_turno = t.id_turno
                JOIN empleado e ON p.id_empleado = e.id_empleado
                ORDER BY p.id_produccion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function Insertar(
        string $fecha_produccion,
        int $id_turno,
        int $id_empleado
    ): bool {

        $sql = "INSERT INTO produccion
                (fecha_produccion, id_turno, id_empleado)
                VALUES (?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $fecha_produccion,
            $id_turno,
            $id_empleado
        ]);
    }

    public function Actualizar(
        int $id_produccion,
        string $fecha_produccion,
        int $id_turno,
        int $id_empleado
    ): bool {

        $sql = "UPDATE produccion
                SET fecha_produccion = ?,
                    id_turno = ?,
                    id_empleado = ?
                WHERE id_produccion = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $fecha_produccion,
            $id_turno,
            $id_empleado,
            $id_produccion
        ]);
    }

    public function Eliminar(int $id): bool {
        $sql = "DELETE FROM produccion
                WHERE id_produccion = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }

            public function ObtenerPorId(int $id_produccion): array|false {

            $sql = "
                SELECT *
                FROM produccion
                WHERE id_produccion = ?
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id_produccion]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function ObtenerUltimoId(): int {

            return (int)$this->db->lastInsertId();
        }

            public function ObtenerProduccionPorTipo(string $tipo): array {

        $sql = "
            SELECT
                p.id_produccion,
                p.fecha_produccion,
                t.nombre_turno,
                e.nombres,
                e.apellidos,
                pr.nombre_producto,
                dp.cantidad
            FROM produccion p
            INNER JOIN turno t
                ON p.id_turno = t.id_turno
            INNER JOIN empleado e
                ON p.id_empleado = e.id_empleado
            INNER JOIN detalle_produccion dp
                ON p.id_produccion = dp.id_produccion
            INNER JOIN producto pr
                ON dp.id_producto = pr.id_producto
            WHERE pr.tipo = ?
            ORDER BY p.id_produccion DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tipo]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        
}