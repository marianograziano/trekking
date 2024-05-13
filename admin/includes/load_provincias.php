<?php

header('Content-Type: application/json');
//var_dump(__DIR__);
require_once '../vendor/autoload.php';  // Make sure this path is correct
require_once '../../config/Database.php';  // Assuming Database is properly configured in Composer's autoload

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $stmt = $pdo->query('SELECT id, provincia FROM provincias');
    $provincias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $provincias
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => "Error connecting to the database: " . $e->getMessage()
    ]);
    exit;
}
?>
