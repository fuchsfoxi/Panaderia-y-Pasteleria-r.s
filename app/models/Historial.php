<?php
require_once __DIR__ . '/../core/Database.php';

class Historial {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTodo(?string $tipo = null, ?string $fecha = null): array {
        $sql = "SELECT 
                    p.id_produccion,
                    p.cantidad_prod,
                    p.hora_agotada,
                    p.id_turno,
                    p.id_producto,
                    t.nombre_turno,
                    pr.nombre_prod,
                    tp.tipo
                FROM produccion p
                JOIN producto pr ON p.id_producto = pr.id_producto
                JOIN tipo tp ON pr.id_tipo = tp.id_tipo
                JOIN turno t ON p.id_turno = t.id_turno
                WHERE 1=1";

        $params = [];

        if ($tipo !== null && $tipo !== 'todos') {
            $sql .= " AND tp.tipo = ?";
            $params[] = $tipo;
        }

        // Filtro por fecha: si hora_agotada es NULL, no aparece en filtro por fecha
        if ($fecha !== null && $fecha !== '') {
            $sql .= " AND DATE(p.hora_agotada) = ?";
            $params[] = $fecha;
        }

        $sql .= " ORDER BY p.id_produccion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}