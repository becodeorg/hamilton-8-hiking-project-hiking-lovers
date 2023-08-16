<?php
declare(strict_types=1);

namespace Models;

use PDO;

<<<<<<< HEAD
class Hike extends Database
=======
class Hikes extends Database
>>>>>>> 191d2e3c2104ccaddb7a33514e6cf680f1bed47b
{
    public function findAll(int $limit = 0): array
    {
        if ($limit === 0) {
            $sql = "SELECT * FROM Hikes";
        } else {
            $sql = "SELECT * FROM Hikes LIMIT " . $limit;
        }
        $stmt = $this->query($sql);
        $hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $hikes;
    }

    public function find(string $id): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM Hikes WHERE id = ?",
            [$id]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 191d2e3c2104ccaddb7a33514e6cf680f1bed47b
