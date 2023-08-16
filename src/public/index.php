<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Controllers\AuthController;
use Controllers\PageController;
use Controllers\HikeController;

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);



try {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    $method = $_SERVER['REQUEST_METHOD']; // GET -- POST

    switch ($url_path) {
        case "":
        case "/index.php":
            $hikeController = new HikeController();
            $hikeController->index();
            break;
        case "product":
            $hikeController = new HikeController();
            $hikeController->show($_GET['id']);
            break;
        case "login":
            $authController = new AuthController();
            if ($method === "GET") $authController->showLoginForm();
            if ($method === "POST") $authController->login($_POST['nickname'], $_POST['password']);
            break;
        case "logout":
            $authController = new AuthController();
            $authController->logout();
            break;
        case "register":
            $authController = new AuthController();
            if ($method === "GET") $authController->showRegistrationForm();
            if ($method === "POST") $authController->register($_POST['firstname'],$_POST['lastname'],$_POST['nickname'],$_POST['email'], $_POST['password']);
            break;
        default:
            $pageController = new PageController();
            $pageController->page_404();
    }
} catch (Exception $e) {
    $pageController = new PageController();
    $pageController->page_500($e->getMessage());
}

