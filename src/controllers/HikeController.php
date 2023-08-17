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

    public function index ()
    {
        try {
            $hike = (new Hike())->findAll(20);

            // 3 - Affichage de la liste des produits
            include 'views/layout/header.view.php';
            include 'views/index.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $hike = (new Hike())->find($id);

            if (empty($id)) {
                (new PageController())->page_404();
                die;
            }

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/hike.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function addHike(int $user_id,string $hikenameInput, string $distanceInput, string $durationInput, string $elevation_gainInput, string $descriptionInput)
{
    if (empty($hikenameInput) ||empty($distanceInput) || empty($durationInput) || empty($elevation_gainInput) || empty($descriptionInput)) {
        throw new Exception('Formulaire non complet');
    }

    $hikename = htmlspecialchars($hikenameInput);
    $distance = htmlspecialchars($distanceInput);
    $duration = htmlspecialchars($durationInput);
    $elevation_gain =htmlspecialchars($elevation_gainInput);
    $description =htmlspecialchars($descriptionInput);

    $this->db->query(
        "
            INSERT INTO Hikes (user_id,name,distance,duration, elevation_gain, description) 
            VALUES (?, ?, ?, ?, ?,?)
        ",
        [$user_id,$hikename, $distance, $duration, $elevation_gain, $description]
    );



    http_response_code(302);
    header('location: /');
}

public function showAddHikeForm()
    {
        include 'views/layout/header.view.php';
        include 'views/addhike.view.php';
        include 'views/layout/footer.view.php';
    }

}