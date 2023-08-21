<?php


namespace core;

use Controllers\AuthController;
use Controllers\UserController;
use Controllers\PageController;
use Controllers\HikeController;


class Router
{
    public function route(string $url_path, string $method): void
    {


        switch ($url_path) {
            case "":
            case "/":
                $authController = new AuthController();
                if ($method === "GET") $authController->showLoginForm();
                if ($method === "POST") $authController->login($_POST['nickname'], $_POST['password']);
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


            default:
                $pageController = new PageController();
                $pageController->page_404();
        }
    }
}