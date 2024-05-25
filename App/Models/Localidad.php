<?php

namespace App\Models;

class Localidad {
    private $conn;
    private $table_name = "localidades";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readByProvincia($id_provincia) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_provincia = :id_provincia";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_provincia', $id_provincia);
        $stmt->execute();

        return $stmt;
    }
}
