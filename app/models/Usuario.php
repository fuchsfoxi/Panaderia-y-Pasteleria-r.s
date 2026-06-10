<?php

require_once __DIR__ . '/../core/Database.php';

class Usuario {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }


        public function existeUsuario(string $nombre_usuario): bool {

            $sql = "
                SELECT COUNT(*)
                FROM usuario
                WHERE nombre_usuario = ?
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$nombre_usuario]);

            return $stmt->fetchColumn() > 0;
        }

            public function buscarPorNombre(string $nombre_usuario): array|false {

                $sql = "
                    SELECT 
                        u.id_usuario,
                        u.nombre_usuario,
                        u.clave,
                        u.estado,
                        u.id_rol,
                        r.nombre_rol,
                        e.nombres,
                        e.apellidos
                    FROM usuario u
                    INNER JOIN rol r
                        ON u.id_rol = r.id_rol
                    LEFT JOIN empleado e
                        ON u.id_empleado = e.id_empleado
                    WHERE u.nombre_usuario = ?
                ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute([$nombre_usuario]);

                return $stmt->fetch(PDO::FETCH_ASSOC);
            }


            public function listar_usuario(): array {

                $sql = "
                    SELECT
                        u.id_usuario,
                        u.nombre_usuario,
                        u.estado,
                        r.nombre_rol,
                        CONCAT(
                            COALESCE(e.nombres,''),
                            ' ',
                            COALESCE(e.apellidos,'')
                        ) AS empleado
                    FROM usuario u
                    INNER JOIN rol r
                        ON u.id_rol = r.id_rol
                    LEFT JOIN empleado e
                        ON u.id_empleado = e.id_empleado
                    ORDER BY u.id_usuario DESC
                ";

                return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            }

            public function insertar_usuario(
                string $nombre_usuario,
                string $clave,
                int $id_rol,
                ?int $id_empleado = null
            ): bool {

                $sql = "
                    INSERT INTO usuario (
                        nombre_usuario,
                        clave,
                        id_rol,
                        id_empleado
                    )
                    VALUES (?, ?, ?, ?)
                ";

                $stmt = $this->db->prepare($sql);

                return $stmt->execute([
                    $nombre_usuario,
                    password_hash($clave, PASSWORD_DEFAULT),
                    $id_rol,
                    $id_empleado
                ]);
            }


            public function cambiarEstado_usuario(
                int $id_usuario,
                bool $estado
            ): bool {

                $sql = "
                    UPDATE usuario
                    SET estado = ?
                    WHERE id_usuario = ?
                ";

                $stmt = $this->db->prepare($sql);

                return $stmt->execute([
                    $estado,
                    $id_usuario
                ]);
            }

}
