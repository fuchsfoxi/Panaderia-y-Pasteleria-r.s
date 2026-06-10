<?php

require_once __DIR__ . '/../core/Database.php';

class detalles_produccion {
    private PDO $db;

    public function __construct(){
        $this ->db = Database::getConnection();
    }

        public function obtenerDetallesProduccion(): array {
            $sql = "SELECT
                        dp.id_detalles_produccion,
                        p.fecha_produccion,
                        t.nombre_turno,
                        e.nombre_emp,
                        e.apellido_emp,
                        pr.nombre_producto,
                        dp.cantidad_prod
                    FROM detalles_produccion dp
                    JOIN produccion p ON dp.id_produccion = p.id_produccion
                    JOIN turno t ON p.id_turno = t.id_turno
                    JOIN empleado e ON p.id_empleado = e.id_empleado
                    JOIN producto pr ON dp.id_producto = pr.id_producto
                    ORDER BY dp.id_detalles_produccion DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        public function insertar{
            $sql = "INSERT INTO detalles_produccion
                    (id_produccion, id_producto, cantidad_prod)
                    VALUES (?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                $id_produccion,
                $id_producto,
                $cantidad_prod
            ]);

            public function actualizar{
            $sql = "UPDATE detalles_produccion
                    SET id_produccion = ?,
                        id_producto = ?,
                        cantidad_prod = ?
                    WHERE id_detalles_produccion = ?";
            }
            public function eliminar{
            $sql = "DELETE FROM detalles_produccion
                    WHERE id_detalles_produccion = ?";

                $stmt = $this->db->prepare($sql);

                return $stmt->execute([$id]);
        }
    }
}