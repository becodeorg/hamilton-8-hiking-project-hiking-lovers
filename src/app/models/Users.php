<?php
namespace App\models;

class Users extends Database
{
    public function findByFirstname(string $firstname): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Users WHERE firstname = ?",
            [$firstname]
        );

        return $stmt->fetch();
    }

    public function registerNewUserAndReturnId(string $firstname, string $lastname, string $nickname,  string $email, string $passwordHash): string
    {
        $this->query(
            "
                INSERT INTO users (firstname, lastname, nickname, email, password) 
                VALUES (?, ?, ?, ?, ?)
            ",
            [$firstname, $lastname, $nickname, $email, $passwordHash]
        );

        return $this->lastInsertId();
    }
}
