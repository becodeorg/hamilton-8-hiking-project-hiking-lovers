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
}