<?php

require_once __DIR__ . '/../core/Database.php';

class Dashboard {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Devuelve los totales de producción agrupados por tipo para un día.
     * $dia acepta 'today' o 'yesterday'.
     *
     * Resultado ejemplo:
     * [ ['tipo' => 'Pan', 'total' => 320], ['tipo' => 'Torta', 'total' => 5], ... ]
     */
        public function totalesPorDia(string $dia): array {
            $sql = "SELECT 
                        tipo.tipo,
                        SUM(produccion.cantidad_prod) AS total
                    FROM produccion
                    JOIN producto ON produccion.id_producto = producto.id_producto
                    JOIN tipo ON producto.id_tipo = tipo.id_tipo
                    WHERE DATE(produccion.hora_agotada) = CURDATE()
                    GROUP BY tipo.tipo";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        /**
     * Devuelve el nombre del último turno registrado en produccion.
     */
    public function ultimoTurno(): string {
        $sql = "SELECT turno.nombre_turno
                FROM produccion
                JOIN turno ON produccion.id_turno = turno.id_turno
                ORDER BY produccion.hora_agotada DESC
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fila['nombre_turno'] ?? 'Sin registros';
    }
}