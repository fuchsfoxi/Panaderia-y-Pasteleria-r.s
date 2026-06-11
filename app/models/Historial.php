<?php

require_once __DIR__ . '/../core/Database.php';

class Historial {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTodo(?string $tipo = null, ?string $fecha = null): array {

        $sql = "SELECT 
                    produccion.id_produccion,
                    produccion.cantidad_prod,
                    produccion.hora_agotada,
                    producto.id_producto,
                    producto.nombre_prod,
                    tipo.tipo,
                    turno.nombre_turno
                FROM produccion
                JOIN producto ON produccion.id_producto = producto.id_producto
                JOIN tipo ON producto.id_tipo = tipo.id_tipo
                JOIN turno ON produccion.id_turno = turno.id_turno
                WHERE 1=1";

        $params = [];

        // FILTRO POR TIPO (AHORA ES tabla tipo)
        if ($tipo !== null && $tipo !== 'todos') {
            $sql .= " AND tipo.tipo = ?";
            $params[] = $tipo;
        }

        // FILTRO POR FECHA (si hora_agotada es DATETIME)
        if ($fecha !== null && $fecha !== '') {
            $sql .= " AND DATE(produccion.hora_agotada) = ?";
            $params[] = $fecha;
        }

        $sql .= " ORDER BY produccion.id_produccion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}