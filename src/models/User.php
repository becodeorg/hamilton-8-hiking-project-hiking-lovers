<?php
declare(strict_types=1);

namespace Models;

use PDO;


class User extends Database

{
    public function findAll(int $limit = 0): array
    {
        if ($limit === 0) {
            $sql = "SELECT * FROM Users";
        } else {
            $sql = "SELECT * FROM Users LIMIT " . $limit;
        }
        $stmt = $this->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function find(string $id): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Users WHERE id = ?",
            [$id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}