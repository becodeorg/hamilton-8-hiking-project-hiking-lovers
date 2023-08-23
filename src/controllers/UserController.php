<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\User;
use PDO;

class UserController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index ()
    {
        try {
            $user = (new User())->findAll(20);

            // 3 - Affichage de la liste des produits
            include 'views/layout/header.view.php';
            include 'views/user.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $user = (new User())->find($id);

            if (empty($id)) {
                (new PageController())->page_404();
                die;
            }

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/user.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function showUserInfo()
{
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];

        include 'views/layout/header.view.php';
        include 'views/user.view.php'; // Create this view file to display user information
        include 'views/layout/footer.view.php';
    } else {
        // User is not logged in, redirect to login page or handle accordingly
        http_response_code(302);
        header('location: /'); // Redirect to the home page or login page
    }
}

public function editProfile()
{
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        
        include 'views/layout/header.view.php';
        include 'views/editProfile.view.php'; // Create this view file to display the edit profile form
        include 'views/layout/footer.view.php';
    } else {
        // User is not logged in, redirect to login page or handle accordingly
        http_response_code(302);
        header('location: /'); // Redirect to the home page or login page
    }        
}


public function updateProfile(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput, string $passwordInput)
{
    if (empty($firstnameInput) ||empty($lastnameInput) || empty($nicknameInput) || empty($emailInput) || empty($passwordInput)) {
        throw new Exception('Formulaire non complet');
    }

    $firstname = htmlspecialchars($firstnameInput);
    $lastname = htmlspecialchars($lastnameInput);
    $nickname = htmlspecialchars($nicknameInput);
    $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
    $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

    // Retrieve user information from session
    $user = $_SESSION['user'];


    // Update user profile information in the database
    $this->db->query(
        "UPDATE Users SET firstname = ?, lastname = ?, nickname = ?, email = ?, password = ? WHERE id = ?",
        [$firstname, $lastname, $nickname, $email, $passwordHash, $user['id']]
    );


    // Update session data with new profile information
    $_SESSION['user']['firstname'] = $firstnameInput;
    $_SESSION['user']['lastname'] = $lastnameInput;
    $_SESSION['user']['nickname'] = $nicknameInput;
    $_SESSION['user']['email'] = $emailInput;

    http_response_code(302);
    header('location: /?profile_updated=true');
}



public function adminProfile()
{
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];

        include 'views/layout/header.view.php';
        include 'views/admin.view.php'; // Create this view file to display user information
        include 'views/layout/footer.view.php';
    } else {
        // User is not logged in, redirect to login page or handle accordingly
        http_response_code(302);
        header('location: /'); // Redirect to the home page or login page
    }
}

public function showAllUsersAdmin(): void
    {
        try {
            $users = (new User())->findAll();

            include 'views/layout/header.view.php';
            include 'views/user_list_admin.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    public function editProfileAdmin()
{
    if (isset($_SESSION['user'])) {
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];

            include 'models/User.php';

            $user = new User(); 

            
            $user_data = $user->find($user_id);


            if ($user_data !== false) {

                $user->firstname = $user_data['firstname'];
                $user->lastname = $user_data['lastname'];
                $user->nickname = $user_data['nickname'];
                $user->email = $user_data['email'];
                
                include 'views/layout/header.view.php';
                include 'views/editProfileAdmin.view.php'; 
                include 'views/layout/footer.view.php';
            } else {
                // Handle the case when the user is not found
                http_response_code(404); // Not Found
                echo "User not found";
            }
        } else {
            
            http_response_code(302);
            header('location: /');
        }
    } else {
        
        http_response_code(302);
        header('location: /'); 
    }      
}



public function updateProfileAdmin(string $firstnameInput, string $lastnameInput, string $nicknameInput, string $emailInput)
{
    if (empty($firstnameInput) ||empty($lastnameInput) || empty($nicknameInput) || empty($emailInput)) {
        throw new Exception('Formulaire non complet');
    }

    $firstname = htmlspecialchars($firstnameInput);
    $lastname = htmlspecialchars($lastnameInput);
    $nickname = htmlspecialchars($nicknameInput);
    $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
    

    // Retrieve user information from session
    $user = $_SESSION['user'];


    // Update user profile information in the database
    $this->db->query(
        "UPDATE Users SET firstname = ?, lastname = ?, nickname = ?, email = ?, password = ? WHERE id = ?",
        [$firstname, $lastname, $nickname, $email, $passwordHash, $user['id']]
    );


    // Update session data with new profile information
    $_SESSION['user']['firstname'] = $firstnameInput;
    $_SESSION['user']['lastname'] = $lastnameInput;
    $_SESSION['user']['nickname'] = $nicknameInput;
    $_SESSION['user']['email'] = $emailInput;

    http_response_code(302);
    header('location: /?profile_updated=true');
}




}