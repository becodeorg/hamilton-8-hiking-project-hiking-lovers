<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Controllers\AuthController;
use Controllers\PageController;
use Controllers\HikeController;
use Controllers\UserController;


session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['profile_updated']) && $_GET['profile_updated'] === 'true') {
    echo '<script>alert("Your profile is updated!");</script>';
}

if (isset($_GET['addhike']) && $_GET['addhike'] === 'true') {
    echo '<script>alert("Your hike has been added");</script>';}

if (isset($_GET['hike_updated']) && $_GET['hike_updated'] === 'true') {
        echo '<script>alert("Your hike is updated!");</script>';
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
         case "user":
                $userController = new UserController();
                if ($method === "GET") $userController->showUserInfo();
                break;
        case "myhikes":
                $hikeController = new HikeController();
                if ($method === "GET") $hikeController->allHikeofUser();
                break;
        case "editprofile":
                $userController = new UserController();
                if ($method === "GET") $userController->editProfile();
                break;
        case "updateprofile":
                $userController = new UserController();
                if ($method === "POST")$userController->updateProfile($_POST['firstname'], $_POST['lastname'], $_POST['nickname'], $_POST['email'], $_POST['password']);
                break;
        case "addhike":
                $hikeController = new HikeController();
                if ($method === "GET") $hikeController->showAddHikeForm();
                
                if ($method === "POST") $hikeController->addHike($_SESSION['user']['id'],$_POST['hikename'],$_POST['distance'],$_POST['duration'],$_POST['elevation_gain'], $_POST['description']);
                break;

        case "editHike":
                $hikeController = new HikeController();
                if ($method === "GET") {
                $hikeId = $_GET['hike_id'] ?? null;
                $hikeController->editHike($hikeId);
                    }
                break;

        case "updatehike":
                $hikeController = new HikeController();
                if ($method === "POST") {
                    $hikeId = $_POST['hike_id'] ?? null; // Fetch hike_id from the POST data
                    $hikeController->updateHike($hikeId,$_POST['name'], $_POST['distance'], $_POST['duration'], $_POST['elevation_gain'], $_POST['description']);
                }
                    break;


                

        case "deletehike":
                $hikeController = new HikeController();
                if ($method === "GET" && isset($_GET['id'])) {
                $hikeController->deleteHike($_GET['id']);
                    }
                break;
                
                
                
            

        default:
            $pageController = new PageController();
            $pageController->page_404();
    }
} catch (Exception $e) {
    $pageController = new PageController();
    $pageController->page_500($e->getMessage());
}

