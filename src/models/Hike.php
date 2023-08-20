<?php
declare(strict_types=1);

namespace Models;

use PDO;


class Hikes extends Database

{
    public function findAll(int $limit = 0): array
    {
        if ($limit === 0) {
            $sql = "SELECT * FROM Hikes";
        } else {
            $sql = "SELECT * FROM Hikes LIMIT " . $limit;
        }
        $stmt = $this->query($sql);
        $hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $hikes;
    }

    public function find(string $id): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Hikes WHERE id = ?",
            [$id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


   
}



