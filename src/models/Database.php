<?php
declare(strict_types=1);

namespace Models;


use PDO;
use PDOStatement;


class Database

{
    private PDO $pdo;

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
    {
        $stmt = $this->pdo->prepare($query);

        foreach($params as $key=> $value){

            if(gettype($value) == "integer") {
                $stmt->bindParam($key, $value, PDO::PARAM_INT);

            } else if (gettype($value) == "boolean") {
                $stmt->bindParam($key, $value, PDO::PARAM_BOOL);

            } else {
                $stmt->bindParam($key, $value);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function exec(string $sql, array $param = []): bool
    {
        // prépare la requête
        $stmt = $this->pdo->prepare($sql);

        foreach($param as $key=> $value){
            if(gettype($value) == "integer") {
                $stmt->bindParam($key, $value, PDO::PARAM_INT);

            } else if (gettype($value) == "boolean") {
                $stmt->bindParam($key, $value, PDO::PARAM_BOOL);

            } else {
                $stmt->bindParam($key, $value);
            }
        }
        return $stmt->execute();
        // Il retourne un bool avec cette valeur

    }
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}