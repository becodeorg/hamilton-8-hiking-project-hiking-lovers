<?php
declare(strict_types=1);

namespace Controllers;

error_reporting(E_ALL);

ini_set('display_errors', '1');


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
            include 'views/hike_list.view.php';
            include 'views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    public function showAllHikeAdmin(): void
    {
        try {
            $hikes = (new Hike())->findAll();

            include 'views/layout/header.view.php';
            include 'views/hike_list_admin.view.php';
            include 'views/layout/footer.view.php';

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function showOneHike(string $id)
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

    public function allHikeofUser() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            // Fetch user's hikes (replace this with your method to retrieve hikes)
            $hikes = $this->getHikesOfUser($user['id']); // Adjust based on your data structure

            include 'views/layout/header.view.php';
            include 'views/myhikes.view.php'; // Pass $hikes to this view
            include 'views/layout/footer.view.php';
        } else {
            // User is not logged in, redirect to login page or handle accordingly
            http_response_code(302);
            header('location: /'); // Redirect to the home page or login page
        }
    }

    // Method to retrieve user's hikes (replace this with your actual method)
    private function getHikesOfUser($userId) {
        // Implement logic to retrieve user's hikes from the database
        // For example:
        $query = "SELECT * FROM Hikes WHERE user_id = ?";
        
        $stmt = $this->db->query($query, [$userId]); // Use the user's ID as a parameter
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function editHike()
{
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        
        $hikeId = $_GET['hike_id']; 
        $hike = $this->fetchHike($hikeId);
        
        include 'views/layout/header.view.php';
        include 'views/edithike.view.php'; // Create this view file to display the edit profile form
        include 'views/layout/footer.view.php';
    } else {
        // User is not logged in, redirect to login page or handle accordingly
        http_response_code(302);
        header('location: /'); // Redirect to the home page or login page
    }        
}

private function fetchHike($hikeId) {
    // Implement logic to retrieve hike information by $hikeId from the database
    // For example:
    $query = "SELECT * FROM Hikes WHERE id = ?";
    
    $stmt = $this->db->query($query, [$hikeId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function deleteHike(string $hikeId)
{
    // Check if the user is logged in
    if (!isset($_SESSION['user'])) {
        // User is not logged in, handle accordingly
        http_response_code(302);
        header('location: /');
        return;
    }

   

    // Delete the hike
    try {
        $this->db->query("DELETE FROM Hikes WHERE id = ?", [$hikeId]);
        // Optionally, you can add a success message here
    } catch (PDOException $e) {
        // Handle the error, log, or display a message
        echo "Error deleting hike: " . $e->getMessage();
    }

    // Redirect back to the user's hike list or another appropriate page
    http_response_code(302);
    header('location: /myhikes'); // Adjust the URL as needed
}



public function updateHike(string $hikeId,string $nameInput, string $distanceInput, string $durationInput, string $elevation_gainInput, string $descriptionInput)
{
    if (empty($nameInput) ||empty($distanceInput) || empty($durationInput) || empty($elevation_gainInput) || empty($descriptionInput)) {
        throw new Exception('Formulaire non complet');
    }

    $hikename = htmlspecialchars($nameInput);
    $distance = htmlspecialchars($distanceInput);
    $duration = htmlspecialchars($durationInput);
    $elevation_gain = htmlspecialchars($elevation_gainInput);
    $description = htmlspecialchars($descriptionInput);

    // Retrieve user information from session
    $user = $_SESSION['user'];
    $hikeId = (string) $hikeId;
try{
    // Update user profile information in the database
    $this->db->query(
        "UPDATE Hikes SET name = ?, distance = ?, duration = ?, elevation_gain = ?, description = ? WHERE id = ?",
        [$hikename, $distance, $duration, $elevation_gain, $description, $hikeId]
    );
}catch (PDOException $e) {
    // Log the error or display a message
    echo "Error updating hike: " . $e->getMessage();
}


    // Update session data with new profile information
    $_SESSION['hike']['name'] = $nameInput;
    $_SESSION['hike']['distance'] = $distanceInput;
    $_SESSION['hike']['duration'] = $durationInput;
    $_SESSION['hike']['elevation_gain'] = $elevation_gainInput;
    $_SESSION['hike']['description'] = $descriptionInput;


    var_dump("Update query executed");         // Debugging output
    var_dump($_SESSION['hike']);      

    http_response_code(302);
    header('location: /?hike_updated=true');
}

public function showAddHikeForm()
    {
        include 'views/layout/header.view.php';
        include 'views/addhike.view.php';
        include 'views/layout/footer.view.php';
    }

    public function addhike(string $nameInput, string $distanceInput, string $durationInput, string $elevation_gainInput, string $descriptionInput, int $user_idInput)
    {
        if (empty($nameInput) ||empty($distanceInput) || empty($durationInput) || empty($elevation_gainInput) || empty($descriptionInput)) {
            throw new Exception('Formulaire non complet');
        }
    
        $hikename = htmlspecialchars($nameInput);
        $distance = htmlspecialchars($distanceInput);
        $duration = htmlspecialchars($durationInput);
        $elevation_gain = htmlspecialchars($elevation_gainInput);
        $description = htmlspecialchars($descriptionInput);

        $this->db->query(
            "
                INSERT INTO Hikes (name,distance,duration, elevation_gain, description,user_id) 
                VALUES (?, ?, ?, ?, ?,?)
            ",
            [$hikename, $distance, $duration, $elevation_gain, $description, $user_idInput]
        );

        $_SESSION['hike'] = [
            'id' => $this->db->lastInsertId(),
            'name' => $hikename,
            'distance' => $distance,
            'duration' => $duration,
            'elevation_gain' => $elevation_gain,
            'description' => $description

        ];

        http_response_code(302);
        header('location: /user');
    }

}






    

