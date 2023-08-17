<?php
namespace Controllers;

use Models\Database;
use Controllers\AuthController;


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
    public function searchUsers($query)
    {
        $stmt = $this->db->query(
            "SELECT * FROM Users WHERE firstname LIKE ? OR lastname LIKE ?",
            ["%$query%", "%$query%"]
        );
        return $stmt->fetchAll();
    }
}