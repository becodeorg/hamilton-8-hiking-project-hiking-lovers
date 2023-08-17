<?php
declare(strict_types=1);

namespace Controllers;

use Controllers\UserController;
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
        if (empty($firstnameInput) || empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);
        $lastname = htmlspecialchars($lastnameInput);
        $nickname = htmlspecialchars($nicknameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

        $this->db->query(
            "
                INSERT INTO Users (firstname,lastname,nickname, email, password) 
                VALUES (?, ?, ?, ?, ?)
            ",
            [$firstname, $lastname, $nickname, $email, $passwordHash]
        );

        $_SESSION['user'] = [
            'id' => $this->db->lastInsertId(),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
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

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nickname' => $nickname,
            'email' => $user['email']
        ];

        // Redirect to home page
        http_response_code(302);
        header('Location: /profile.php');
        exit();
    }

    public function showLoginForm()
    {
        include 'views/layout/header.view.php';
        include 'views/index.view.php';
        include 'views/layout/footer.view.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);
        http_response_code(302);
        header('location: /');
    }

    public function userlist()
    {
        $userController = new UserController();
        $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

        if (!empty($searchQuery)) {
            $users = $userController->searchUsers($searchQuery);
        } else {
            $users = $userController->getAllUsers();
        }

        include "views/layout/header.view.php";
        include "views/users_list.view.php";
        include "views/layout/footer.view.php";
    }
}