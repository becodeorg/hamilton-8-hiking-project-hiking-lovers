<?php
<<<<<<< HEAD
=======


>>>>>>> 191d2e3c2104ccaddb7a33514e6cf680f1bed47b
declare(strict_types=1);

namespace Models;

<<<<<<< HEAD

use PDO;
use PDOStatement;


class Database

{
    private PDO $pdo;

=======
use PDO;
use PDOStatement;

class Database
{
    // Private : la visibilité de la propriété est limitée à même la classe. On ne peut pas y accéder en dehors de la classe.
    private PDO $pdo;

    //Inside the constructor, a new PDO connection is established using the database credentials obtained from environment variables (getenv).
    // The connection attributes are then configured for error handling and result fetching modes.
>>>>>>> 191d2e3c2104ccaddb7a33514e6cf680f1bed47b
    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );

        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query, array $params = []): PDOStatement
<<<<<<< HEAD
=======
        // public function query(string $query, array $params = []): PDOStatement:
        // This method accepts an SQL query string ($query) and an optional array of parameters ($params).
        // It prepares and executes the query using the provided parameters.
        // The method returns a PDOStatement object, which can be used to fetch results.
>>>>>>> 191d2e3c2104ccaddb7a33514e6cf680f1bed47b
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