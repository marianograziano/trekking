<?php
require __DIR__ . '/../../../vendor/autoload.php'; 
use phpGPX\phpGPX;

// Función para obtener el path del archivo GPX basado en el ID del sendero
function getFilePathById($senderoId) {
    // Sanitizar el ID del sendero para evitar inyecciones de ruta de archivo
    $safeSenderoId = basename($senderoId);
    $filePath = "./uploads/" . $safeSenderoId . "-temp.gpx";
    return $filePath;
}

// Capturar datos desde una solicitud POST
$data = json_decode(file_get_contents("php://input"), true);
// Esto mostrará los datos recibidos en el log del servidor o en la salida del error

$senderoId = $data['senderoId'] ?? '';
$name = $data['name'] ?? '';
$description = $data['description'] ?? '';

// Validar los inputs
if (empty($senderoId) || empty($name) || empty($description)) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['error' => 'Los campos necesarios no están presentes o están vacíos']);
    exit;
}

// Obtener la ruta del archivo GPX basada en el ID del sendero
$gpxFilePath = getFilePathById($senderoId);

if (!file_exists($gpxFilePath)) {
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode(['error' => 'Archivo GPX no encontrado']);
    exit;
}

try {
    // Cargar el archivo GPX existente
    $gpx = new phpGPX();
    $file = $gpx->load($gpxFilePath);

    // Actualizar los metadatos del archivo GPX
    $file->metadata->name = $name;
    $file->metadata->description = $description;

    // Guardar el archivo GPX modificado
    $file->save($gpxFilePath, phpGPX::XML_FORMAT);

    // Enviar respuesta exitosa
    header('Content-Type: application/json');
    echo json_encode(['success' => 'Metadatos actualizados con éxito', 'fileName' => basename($gpxFilePath)]);
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'Error al procesar el archivo GPX: ' . $e->getMessage()]);
}
?>
