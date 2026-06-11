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
                    p.fecha_produccion,
                    pr.id_producto,
                    pr.nombre_prod,
                    t.tipo,
                    p.cantidad_prod,
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

        // YA NO EXISTE detalle_produccion en tu BD
        $sql = "DELETE FROM produccion WHERE id_produccion = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function insertar(int $id_turno, array $productos): bool {

        $sql = "INSERT INTO produccion (fecha_produccion, id_turno, id_producto, cantidad_prod) 
                VALUES (CURDATE(), ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        foreach ($productos as $producto) {
            $ok = $stmt->execute([
                $id_turno,
                $producto['id_producto'],
                $producto['cantidad']
            ]);

            if (!$ok) {
                return false;
            }
        }

        return true;
    }

    public function actualizar(int $id, int $id_turno, array $productos): bool {

        $sql = "UPDATE produccion 
                SET id_turno = ?
                WHERE id_produccion = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt->execute([$id_turno, $id])) {
            return false;
        }

        // como ya no existe detalle_produccion, solo reinsertamos registros
        foreach ($productos as $producto) {

            $sqlInsert = "INSERT INTO produccion (fecha_produccion, id_turno, id_producto, cantidad_prod)
                          VALUES (CURDATE(), ?, ?, ?)";

            $stmtInsert = $this->db->prepare($sqlInsert);

            if (!$stmtInsert->execute([
                $id_turno,
                $producto['id_producto'],
                $producto['cantidad']
            ])) {
                return false;
            }
        }

        return true;
    }
}