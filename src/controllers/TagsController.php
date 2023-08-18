<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\Database;
use Models\Tags;
use PDO;

class TagsController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index ()
    {
        try {
            $tag = (new Tags())->findAll(20);

            // 3 - Affichage de la liste des produits
            include 'views/layout/header.view.php';
            include 'views/tags.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $tag = (new Tags())->find($id);

            if (empty($id)) {
                (new PageController())->page_404();
                die;
            }

            // 3 - Afficher la page
            include 'views/layout/header.view.php';
            include 'views/tags.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function addTags(int $user_id, int $idtagInput, string $tagnameInput)
    {
        if (empty($tagnameInput) ||empty($idtagInput)) {
            throw new Exception('Formulaire non complet');
        }
        $idtag = intdiv($idtagInput);
        $tagname = htmlspecialchars($tagnameInput);

        $this->db->query(
            "
            INSERT INTO Tags (user_id, id, name) 
            VALUES (?, ?, ?)
        ",
            [$user_id, $idtag, $tagname ]
        );

        $_SESSION['user'] = [
            'id' => $this->db->lastInsertId(),
            'name' => $tagname,

        ];

        http_response_code(302);
        header('location:/Tags');
    }

    public function showAddHikeForm()
    {
        include 'views/layout/header.view.php';
        include 'views/tags.view.php';
        include 'views/layout/footer.view.php';
    }

}
