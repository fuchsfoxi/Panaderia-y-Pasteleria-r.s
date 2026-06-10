<?php

require_once __DIR__ . '/../core/Database.php';

class Historial {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function btenerTodo(?string $tipo = null, ?string $fecha = null): array {
        $sql = "SELECT 
                    produccion.id_produccion,
                    produccion.id_producto,
                    produccion.id_turno,
                    producto.nombre_prod,
                    tipo.tipo,
                    produccion.cantidad_prod,
                    produccion.hora_agotada,
                    turno.nombre_turno,
                    DATE_FORMAT(produccion.hora_agotada, '%d/%m/%Y') as fecha,
                    DATE_FORMAT(produccion.hora_agotada, '%Y-%m-%d') as fecha_raw
                FROM produccion
                JOIN producto ON produccion.id_producto = producto.id_producto
                JOIN tipo ON producto.id_tipo = tipo.id_tipo
                JOIN turno ON produccion.id_turno = turno.id_turno
                WHERE 1=1";

        $params = [];

        if ($tipo !== null && $tipo !== 'todos') {
            $sql .= " AND tipo.tipo = ?";
            $params[] = $tipo;
        }

        if ($fecha !== null && $fecha !== '') {
            $sql .= " AND DATE(produccion.hora_agotada) = ?";
            $params[] = $fecha;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}