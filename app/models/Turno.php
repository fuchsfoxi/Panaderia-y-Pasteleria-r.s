<?php

require_once __DIR__ . '/../core/Database.php';


class Turno {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTurnos(): array {
        $sql = "SELECT
                    id_turno,
                    nombre_turno
                FROM turno
                ORDER BY id_turno DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function insertar(
        string $nombre_turno
    ): bool {

        $sql = "INSERT INTO turno
                (nombre_turno)
                VALUES (?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $nombre_turno
        ]);
    }

    public function actualizar(
        int $id_turno,
        string $nombre_turno
    ): bool {

        $sql = "UPDATE turno
                SET nombre_turno = ?
                WHERE id_turno = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $nombre_turno,
            $id_turno
        ]);
    }

        public function eliminar(int $id): bool {

            $sql = "DELETE FROM turno
                    WHERE id_turno = ?";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([$id]);
        }
        public function obtenerPorId(int $id): array|false {

        $sql = "SELECT *
                FROM turno
                WHERE id_turno = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

        public function obtenerPorNombre(string $nombre_turno): array|false {

            $sql = "SELECT *
                    FROM turno
                    WHERE nombre_turno = ?";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$nombre_turno]);

            return $stmt->fetch();
    }
}