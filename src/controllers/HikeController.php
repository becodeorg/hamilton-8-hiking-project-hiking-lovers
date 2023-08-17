<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\Hike;
use PDO;

class HikeController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index(): void
    {
        try {
            $hike = (new Hike())->findAll(20);


            include 'views/layout/header.view.php';
            include 'views/index.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function show(string $id):void
    {
        try {
            $hike = (new Hike())->find($id);

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/hike.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}