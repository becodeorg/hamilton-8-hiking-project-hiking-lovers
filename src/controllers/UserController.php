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

    

    }

