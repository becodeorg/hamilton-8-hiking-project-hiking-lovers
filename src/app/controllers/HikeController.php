<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Hikes;
use Exception;

class HikeController
{
    public function index()
    {
        try {
            $hikes = (new Hikes())->findAll(20);

            // 3 - Affichage de la liste des produits
            include 'app/views/layout/header.view.php';
            include 'app/views/index.view.php';
            include 'app/views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $hikes = (new Hikes())->find($id);

            if (empty($hikes)) {
                (new PageController())->page_404();
                die;
            }

            // 3 - Afficher la page
            include 'app/views/layout/header.view.php';
            include 'app/views/product.view.php';
            include 'app/views/layout/footer.view.php';

        } catch (Exception $e) {
            (new PageController())->page_500($e->getMessage());
        }
    }
}