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

    public function find(string $user_id): array
    {
        $stmt = $this->query(
            "SELECT * FROM Users WHERE id = ?",
            [$user_id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function loadUserProfile(int $userId)
{
    $stmt = $this->db->query(
        "SELECT id, firstname, lastname, nickname, email FROM Users WHERE id = ?",
        [$userId]
    );

    return $stmt->fetch(); // Returns the user profile data as an associative array
}

   

}
