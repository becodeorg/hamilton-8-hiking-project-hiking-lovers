
<?php
declare(strict_types=1);

namespace app\models;

use PDO;
use PDOStatement;

abstract class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=188.166.24.55;dbname=hamilton-8-lovers',
            'lovers-admin',
            'WxfOxFJTYILIq5yk'
        );

        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}