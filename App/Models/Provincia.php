<?php

namespace App\Models;

use PDO;

class Provincia {
    private $conn;
    private $table_name = "provincias";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id, nombre AS provincia FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
