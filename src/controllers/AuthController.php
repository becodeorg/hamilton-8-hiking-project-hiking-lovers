<?php
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

    public function register(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput, ?int $hikeId = null)
    {
        if (empty($firstnameInput) ||empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);
        $lastname = htmlspecialchars($lastnameInput);
        $nickname = htmlspecialchars($nicknameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

        $this->db->query(
            "
                INSERT INTO Users (firstname,lastname,nickname, email, password, hike_id) 
                VALUES (?, ?, ?, ?, ?, ?)
            ",
            [$firstname, $lastname, $nickname, $email, $passwordHash, $hikeId]
        );

        $_SESSION['user'] = [
            'id' => $this->db->lastInsertId(),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
            'email' => $email
        ];

        http_response_code(302);
        header('location: /user');
    }

    public function showRegistrationForm()
    {
        include 'views/layout/header.view.php';
        include 'views/register.view.php';
        include 'views/layout/footer.view.php';
    }

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

        if (empty($user)) {
            throw new Exception('Mauvais nom d\'utilisateur');
        }

        if (password_verify($passwordInput, $user['password']) === false) {
            throw new Exception('Mauvais mot de passe');
        }

        $redirectionUrl = '/user'; // Default to user profile

    if ($user['role'] === 'admin') {
        $redirectionUrl = '/admin'; // Redirect to admin page if the role is admin
    }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'nickname' => $user['nickname'],
            'email' => $user['email'],
            'password' => $user['password']
            
        
        ];

        // Redirect to user profile
        http_response_code(302);
    header('Location: ' . $redirectionUrl);
    }

    public function showLoginForm()
    {
        include 'views/layout/header.view.php';
        include 'views/login.view.php';
        include 'views/layout/footer.view.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);
        http_response_code(302);
        header('location: /');
    }

   

    










}

