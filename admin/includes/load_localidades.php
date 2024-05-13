<?php
header('Content-Type: application/json');
//var_dump(__DIR__);
require_once '../vendor/autoload.php';  // Make sure this path is correct
require_once '../../config/Database.php';  // Assuming Database is properly configured in Composer's autoload

$idProvincia = isset($_GET['id_provincia']) ? intval($_GET['id_provincia']) : 0;
if ($idProvincia == 0) {
    echo json_encode([]);
    exit;
}

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare('SELECT id, localidad FROM localidades WHERE id_provincia = :id_provincia ORDER BY localidad');
    $stmt->execute(['id_provincia' => $idProvincia]);

    $localidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
        'success' => true,
        'data' => $localidades
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
