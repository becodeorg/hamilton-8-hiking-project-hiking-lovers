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


            include 'views/layout/header.view.php';
            include 'views/user.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    public function show(int $id)
    {
        try {
            if (!ctype_digit($id)) {
                // Gérer le cas où l'identifiant n'est pas valide
                (new PageController())->page_404();
                die;
            }

            $user = (new User())->find($id);

            if (empty($user)) {
                (new PageController())->page_404();
                die;
            }

            // Afficher la page
            include 'views/layout/header.view.php';
            include 'views/user.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            // Gérer l'erreur
            print_r($e->getMessage());
        }
    }

}