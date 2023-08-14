<?php

namespace core;

use controllers\AuthController;

class Router
{

    public function route(string $uri_path): void
    {
        $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
        $method = $_SERVER['REQUEST_METHOD']; // GET -- POST
        switch ($uri_path) {
            case "/":
            case "/index":
                echo "let' go";
            $authController = new AuthController();
            if ($method === "GET") $authController->showRegistrationForm();
            if ($method === "POST") $authController->register($_POST['username'],$_POST['email'], $_POST['password']);
            break;
            case "/users":
                echo "It works!";
                break;
            case "/hikes":
                echo "liste";
            default:
                break;
        }
    }
}