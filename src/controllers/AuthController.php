<?php
<<<<<<< HEAD

namespace controllers;

class AuthController
{
    public function register(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput)
    {
        if (empty($firstnameInput) || empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
=======
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;

class AuthController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput)
    {
        if (empty($firstnameInput) ||empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
>>>>>>> ozlem
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);
        $lastname = htmlspecialchars($lastnameInput);
        $nickname = htmlspecialchars($nicknameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

<<<<<<< HEAD
        $id = (new User())->registerNewUserAndReturnId(
            $firstname,
            $lastname,
            $nickname,
            $email,
            $passwordHash
        );

        $_SESSION['user'] = [
            'id' => $id,
            'firstname' => $firstname,
=======
        $this->db->query(
            "
                INSERT INTO Users (firstname,lastname,nickname, email, password) 
                VALUES (?, ?, ?, ?, ?)
            ",
            [$firstname, $lastname, $nickname, $email, $passwordHash]
        );

        $_SESSION['user'] = [
            'id' => $this->db->lastInsertId(),
            'firstname' => $fisrtname,
            'lastname' => $lastname,
            'nickname' => $nickname,
>>>>>>> ozlem
            'email' => $email
        ];

        http_response_code(302);
        header('location: /');
    }

    public function showRegistrationForm()
    {
        include 'views/layout/header.view.php';
        include 'views/register.view.php';
        include 'views/layout/footer.view.php';
    }

<<<<<<< HEAD
    public function login(string $usernameInput, string $passwordInput)
    {
        if (empty($usernameInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $username = htmlspecialchars($usernameInput);

        $user = (new User())->findByUsername($username);
=======
    public function login(string $nicknameInput, string $passwordInput)
    {
        if (empty($nicknameInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $nickname = htmlspecialchars($nicknameInput);

        $stmt = $this->db->query(
            "SELECT * FROM Users WHERE nickname = ?",
            [$nickname]
        );

        $user = $stmt->fetch();
>>>>>>> ozlem

        if (empty($user)) {
            throw new Exception('Mauvais nom d\'utilisateur');
        }

        if (password_verify($passwordInput, $user['password']) === false) {
            throw new Exception('Mauvais mot de passe');
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
<<<<<<< HEAD
            'username' => $username,
=======
            'nickname' => $nickname,
>>>>>>> ozlem
            'email' => $user['email']
        ];

        // Redirect to home page
        http_response_code(302);
        header('location: /');
    }

    public function showLoginForm()
    {
<<<<<<< HEAD
        include 'app/views/layout/header.view.php';
        include 'app/views/login.view.php';
        include 'app/views/layout/footer.view.php';
=======
        include 'views/layout/header.view.php';
        include 'views/login.view.php';
        include 'views/layout/footer.view.php';
>>>>>>> ozlem
    }

    public function logout()
    {
        unset($_SESSION['user']);
        http_response_code(302);
        header('location: /');
    }
}