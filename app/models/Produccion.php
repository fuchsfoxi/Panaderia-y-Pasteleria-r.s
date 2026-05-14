<?php

require_once __DIR__ . '/../core/Database.php';

class Produccion {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

public function obtenerProduccion(?string $tipo = null): array {
    $sql = "SELECT 
                produccion.id_produccion,
                producto.nombre_prod,
                tipo.tipo,
                produccion.cantidad_prod,
                produccion.hora_agotada,
                turno.nombre_turno
            FROM produccion
            JOIN producto ON produccion.id_producto = producto.id_producto
            JOIN tipo ON producto.id_tipo = tipo.id_tipo
            JOIN turno ON produccion.id_turno = turno.id_turno";

    if ($tipo !== null) {
        $sql .= " WHERE tipo.tipo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tipo]);
    } else {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    return $stmt->fetchAll();
}


public function eliminar(int $id): bool {
    $sql = "DELETE FROM produccion WHERE id_produccion = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$id]);
}

        public function insertar(int $cantidad, int $id_producto, int $id_turno): bool {
    $sql = "INSERT INTO produccion (cantidad_prod, id_producto, id_turno) 
            VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$cantidad, $id_producto, $id_turno]);
}

public function actualizar(int $id, int $cantidad, int $id_producto, int $id_turno): bool {
    $sql = "UPDATE produccion 
            SET cantidad_prod = ?, id_producto = ?, id_turno = ?
            WHERE id_produccion = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$cantidad, $id_producto, $id_turno, $id]);
}
}