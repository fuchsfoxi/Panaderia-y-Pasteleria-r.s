<?php

require_once __DIR__ . '/../core/Database.php';

class Empleado {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Listar todos los empleados
    public function ListarEmpleados(): array {

        $sql = "
            SELECT
                id_empleado,
                nombres,
                apellidos,
                fecha_nacimiento,
                direccion,
                telefono
            FROM empleado
            ORDER BY id_empleado DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un empleado por ID
    public function ObtenerPorId(int $id_empleado): array|false {

        $sql = "
            SELECT
                id_empleado,
                nombres,
                apellidos,
                fecha_nacimiento,
                direccion,
                telefono
            FROM empleado
            WHERE id_empleado = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_empleado]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar empleado
    public function Insertar(
        string $nombres,
        string $apellidos,
        string $fecha_nacimiento,
        string $direccion,
        string $telefono
    ): bool {

        $sql = "
            INSERT INTO empleado
            (
                nombres,
                apellidos,
                fecha_nacimiento,
                direccion,
                telefono
            )
            VALUES (?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $nombres,
            $apellidos,
            $fecha_nacimiento,
            $direccion,
            $telefono
        ]);
    }

    // Actualizar empleado
    public function Actualizar(
        int $id_empleado,
        string $nombres,
        string $apellidos,
        string $fecha_nacimiento,
        string $direccion,
        string $telefono
    ): bool {

        $sql = "
            UPDATE empleado
            SET nombres = ?,
                apellidos = ?,
                fecha_nacimiento = ?,
                direccion = ?,
                telefono = ?
            WHERE id_empleado = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $nombres,
            $apellidos,
            $fecha_nacimiento,
            $direccion,
            $telefono,
            $id_empleado
        ]);
    }

    // Eliminar empleado
    public function Eliminar(int $id_empleado): bool {

        $sql = "
            DELETE FROM empleado
            WHERE id_empleado = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id_empleado]);
    }

    // Ver producciones realizadas por cada empleado
    public function EmpleadoProduccion(): array {

        $sql = "
            SELECT
                e.id_empleado,
                e.nombres,
                e.apellidos,
                COUNT(p.id_produccion) AS total_produccion
            FROM empleado e
            LEFT JOIN produccion p
                ON e.id_empleado = p.id_empleado
            GROUP BY
                e.id_empleado,
                e.nombres,
                e.apellidos
            ORDER BY total_produccion DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}