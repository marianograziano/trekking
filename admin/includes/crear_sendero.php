<?php
header('Content-Type: text/plain; charset=utf-8');
$data = json_decode(file_get_contents("php://input"), true);
require_once '../vendor/autoload.php';  // Make sure this path is correct
require_once '../../config/Database.php';  
$idProvincia = $data['id_provincia'] ?? '';
$idLocalidad = $data['id_localidad'] ?? '';

if (empty($idProvincia) || empty($idLocalidad)) {
    http_response_code(400);
    echo "Provincia o localidad no especificadas.";
    exit;
}

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('INSERT INTO senderos (id_provincia, id_localidad) VALUES (?, ?)');
    $stmt->execute([$idProvincia, $idLocalidad]);
    echo $pdo->lastInsertId();
} catch (PDOException $e) {
    http_response_code(500);
    echo "Error al insertar sendero: " . $e->getMessage();
}
?>