<?php

namespace core;

use Controllers\AuthController;
use Controllers\TagsController;
use Controllers\UserController;
use Controllers\PageController;
use Controllers\HikeController;

class Router
{
    public function route(string $url_path, string $method): void
    {
        // Vérifier si l'utilisateur est connecté
        $authController = new AuthController();
        $isLoggedIn = $authController->checkIfLoggedIn();

        switch ($url_path) {
            case "":
            case "/":
                if ($isLoggedIn) {
                    header("Location: /user"); // Redirige vers la page de profil
                    exit();
                } else {
                    $authController = new AuthController();
                    if ($method === "GET") $authController->showLoginForm();
                    if ($method === "POST") $authController->login($_POST['nickname'], $_POST['password']);
                }
                break;
            case "/user":
                $usercontroller = new UserController();
                $usercontroller->show($_GET['id']);
                break;
            case "/hikes-list":
                $hikeController = new HikeController();
                $hikeController->showAll();
                break;
            case "/logout":
                $authController = new AuthController();
                $authController->logout();
                break;
            case "/register":
                $authController = new AuthController();
                if ($method === "GET") $authController->showRegistrationForm();
                if ($method === "POST") $authController->register($_POST['firstname'], $_POST['lastname'], $_POST['nickname'], $_POST['email'], $_POST['password']);
                break;
            case "/userlist":
                $authController = new AuthController();
                $authController->userlist();
                break;
           
            case "/tags":
                $tagsController = new TagsController();
                $tagsController->index();
                break;
            default:
                $pageController = new PageController();
                $pageController->page_404();
        }
    }
}