<?php

require_once __DIR__ . '/../core/Database.php';

class Empleados{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listar_empleados(): array {

        $sql = "
            SELECT
                id_empleado,
                nombres,
                apellidos,
                fecha_nacimiento,
                direccion,
                telefono
            FROM empleado
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function empleado_produccion(): array {

        $sql = "
            SELECT
                e.id_empleado,
                e.nombres,
                e.apellidos,
                COUNT(p.id_produccion) AS total_produccion
            FROM empleado e
            LEFT JOIN usuario u ON e.id_empleado = u.id_empleado
            LEFT JOIN produccion p ON u.id_usuario = p.id_usuario
            GROUP BY e.id_empleado
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar_empleado(int $id_empleado): array|false {

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

    public function agregar_empleado(array $datos): bool {

        $sql = "
            INSERT INTO empleado (nombres, apellidos, fecha_nacimiento, direccion, telefono)
            VALUES (?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $datos['nombres'],
            $datos['apellidos'],
            $datos['fecha_nacimiento'],
            $datos['direccion'],
            $datos['telefono']
        ]);
    }

    

}