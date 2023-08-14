<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Users;
use Exception;

class AuthController
{
    public function register(string $firstnameInput, string $lastnameInput, string $emailInput, string $passwordInput)
    {
        if (empty($firstnameInput) || (empty($lastnameInput) || empty($emailInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);
        $lastname= htmlspecialchars($lastnameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

        $id = (new User())->registerNewUserAndReturnId(
            $firstname,
            $lastname,
            $email,
            $passwordHash
        );

        $_SESSION['user'] = [
            'id' => $id,
            'firstname' => $firstname,
            'email' => $email
        ];

        http_response_code(302);
        header('location: /');
    }

    public function showRegistrationForm()
    {
        include 'app/views/layout/header.view.php';
        include 'app/views/register.view.php';
        include 'app/views/layout/footer.view.php';
    }

    public function login(string $firstnameInput, string $lastname, string $passwordInput)
    {
        if (empty($firstnameInput) || empty($lastnameInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $firstname = htmlspecialchars($firstnameInput);

        $user = (new Users())->findByFirstname($firstname);

        if (empty($user)) {
            throw new Exception('Mauvais nom d\'utilisateur');
        }

        if (password_verify($passwordInput, $user['password']) === false) {
            throw new Exception('Mauvais mot de passe');
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $username,
            'email' => $user['email']
        ];

        // Redirect to home page
        http_response_code(302);
        header('location: /');
    }

    public function showLoginForm()
    {
        include 'app/views/layout/header.view.php';
        include 'app/views/login.view.php';
        include 'app/views/layout/footer.view.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);
        http_response_code(302);
        header('location: /');
    }
}