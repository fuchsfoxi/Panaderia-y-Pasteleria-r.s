<?php

require_once __DIR__ . '/../core/Database.php';

class Produccion {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerProduccion(): array {
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

    public function insertar(
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

    public function actualizar(
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

    public function eliminar(int $id): bool {
        $sql = "DELETE FROM produccion
                WHERE id_produccion = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }
}