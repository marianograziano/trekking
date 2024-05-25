<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Provincia;

class ProvinciaController {
    private $conn;
    private $provincia;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->provincia = new Provincia($this->conn);
    }

    public function getAllProvincias() {
        header('Content-Type: application/json'); // Asegúrate de establecer el encabezado de respuesta como JSON
        $stmt = $this->provincia->read();
        $provincias = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        echo json_encode(['data' => $provincias]);
    }
}
