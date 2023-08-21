<?php
namespace Controllers;

use Models\Database;
use Controllers\AuthController;
use PDO;


class UserController
{
    private Database $db;

    public function __construct()
    {
    $this->db = new Database();
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM Users");
        return $stmt->fetchAll();
    }
    public function findUsernameById(string $id): string
    {
        $stmt = $this->db->query(
            "SELECT nickname FROM Users WHERE id = :id",
            ['id' => $id]
        );
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['nickname'] ?? 'Unknown User';
    }
}

