<?php
require_once __DIR__ . '/../core/Database.php';

class Dashboard {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function totalesPorDia(): array {
        // Como no hay fecha_produccion, agrupamos todo o usamos CURDATE() en hora_agotada
        $sql = "SELECT 
                    t.tipo,
                    SUM(p.cantidad_prod) AS total
                FROM produccion p
                JOIN producto pr ON p.id_producto = pr.id_producto
                JOIN tipo t ON pr.id_tipo = t.id_tipo
                WHERE p.hora_agotada IS NULL OR DATE(p.hora_agotada) = CURDATE()
                GROUP BY t.tipo";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ultimoTurno(): string {
        $sql = "SELECT tu.nombre_turno
                FROM produccion p
                JOIN turno tu ON p.id_turno = tu.id_turno
                ORDER BY p.id_produccion DESC
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        return $fila['nombre_turno'] ?? 'Sin registros';
    }
}