<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Controllers\AuthController;
use Controllers\UserController;
use Controllers\PageController;
use Controllers\HikeController;
use Controllers\UserController;


session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['profile_updated']) && $_GET['profile_updated'] === 'true') {
    echo '<script>alert("Your profile is updated!");</script>';
}



try {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    $method = $_SERVER['REQUEST_METHOD']; // GET -- POST

    switch ($url_path) {
        case "":
        case "/index.php":
        $authController = new AuthController();
        if ($method === "GET") $authController->showLoginForm();
        if ($method === "POST") $authController->login($_POST['nickname'], $_POST['password']);
        break;
        case "hike":
            $hikeController = new HikeController();
            $hikeController->show($_GET['id']);
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
        case "userlist":
            $authController = new AuthController();
            $authController->userlist();
            break;
         case "user":
                $authController = new AuthController();
                if ($method === "GET") $authController->showUserInfo();
                break;
        case "editprofile":
                $authController = new AuthController();
                if ($method === "GET") $authController->editProfile();
                break;
        case "updateprofile":
                $authController = new AuthController();
                if ($method === "POST")$authController->updateProfile($_POST['firstname'], $_POST['lastname'], $_POST['nickname'], $_POST['email'], $_POST['password']);
                break;
                
            

        default:
            $pageController = new PageController();
            $pageController->page_404();
    }
} catch (Exception $e) {
    $pageController = new PageController();
    $pageController->page_500($e->getMessage());
}

