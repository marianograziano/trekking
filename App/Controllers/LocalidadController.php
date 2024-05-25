<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Localidad;

class LocalidadController {
    private $conn;
    private $localidad;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->localidad = new Localidad($this->conn);
    }

    public function getLocalidadesByProvincia($provincia_id) {
        header('Content-Type: application/json'); // Asegúrate de establecer el encabezado de respuesta como JSON
        $stmt = $this->localidad->readByProvincia($provincia_id);
        $localidades = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        echo json_encode(['data' => $localidades]);
    }
}
