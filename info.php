<?php
header('Content-Type: application/json');

require_once '../vendor/autoload.php';  /// Asegúrate de que la ruta es correcta

require_once 'config/Database.php';

// Función para probar la conexión y recuperación de datos
function testDatabaseConnection() {
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
            'error' => "Error conectando a la base de datos: " . $e->getMessage()
        ]);
        exit;
    }
}

// Llamada a la función de prueba
testDatabaseConnection();
?>