<?php
require_once __DIR__ . '/../core/Database.php';

class Produccion {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

        public function obtenerProduccion(?string $tipo = null): array {
            $sql = "SELECT 
                        p.id_produccion,
                        p.cantidad_prod,
                        p.hora_agotada,        -- ← debe ser hora_agotada, NO fecha_produccion
                        pr.id_producto,
                        pr.nombre_prod,
                        t.tipo,
                        tu.nombre_turno
                    FROM produccion p
                    JOIN producto pr ON p.id_producto = pr.id_producto
                    JOIN tipo t ON pr.id_tipo = t.id_tipo
                    JOIN turno tu ON p.id_turno = tu.id_turno
                    WHERE 1=1";



        $params = [];

        if ($tipo !== null) {
            $sql .= " AND t.tipo = ?";
            $params[] = $tipo;
        }

        $sql .= " ORDER BY p.id_produccion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar(int $id): bool {
        $sql = "DELETE FROM produccion WHERE id_produccion = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Insertar UNA sola producción (no array)
    public function insertar(int $id_turno, int $id_producto, int $cantidad_prod, ?string $hora_agotada = null): bool {
        $sql = "INSERT INTO produccion (cantidad_prod, hora_agotada, id_producto, id_turno) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$cantidad_prod, $hora_agotada, $id_producto, $id_turno]);
    }

    // Actualizar una producción existente
    public function actualizar(int $id, int $id_turno, int $id_producto, int $cantidad_prod, ?string $hora_agotada = null): bool {
        $sql = "UPDATE produccion 
                SET id_turno = ?, id_producto = ?, cantidad_prod = ?, hora_agotada = ?
                WHERE id_produccion = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_turno, $id_producto, $cantidad_prod, $hora_agotada, $id]);
    }
}