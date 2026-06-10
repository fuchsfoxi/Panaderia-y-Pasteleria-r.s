<?php

require_once __DIR__ . '/../core/Database.php';

class Dashboard {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Obtiene los totales producidos hoy agrupados por tipo.
     */
    public function totalesPorDia(): array {

        $sql = "
            SELECT
                p.tipo,
                SUM(dp.cantidad) AS total
            FROM detalle_produccion dp
            INNER JOIN producto p
                ON dp.id_producto = p.id_producto
            INNER JOIN produccion pr
                ON dp.id_produccion = pr.id_produccion
            WHERE pr.fecha_produccion = CURDATE()
            GROUP BY p.tipo
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Devuelve el último turno registrado.
     */
    public function ultimoTurno(): string {

        $sql = "
            SELECT t.nombre_turno
            FROM produccion p
            INNER JOIN turno t
                ON p.id_turno = t.id_turno
            ORDER BY p.id_produccion DESC
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        return $fila['nombre_turno'] ?? 'Sin registros';
    }

    /**
     * Devuelve los totales organizados por tipo.
     */
    public function totalesMapeados(): array {

        $mapa = [
            'PAN' => 0,
            'TORTA' => 0,
            'BOCADITO' => 0
        ];

        foreach ($this->totalesPorDia() as $fila) {
            $mapa[$fila['tipo']] = (int)$fila['total'];
        }

        return $mapa;
    }
}