<?php
header('Content-Type: application/json');
require __DIR__ . '/../../../vendor/autoload.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

if (!empty($_FILES['fileGPX']['tmp_name']) && !empty($_POST['senderoId'])) {
    // Usar el nombre original del archivo subido
    $originalName = basename($_FILES['fileGPX']['name']); // Usa basename() para evitar path traversal attacks

    // Usar senderoId de POST para estructurar la carpeta si es necesario
    $senderoId = 'sendero';

    // Crear un directorio específico para el sendero si no existe
    $uploadDir = __DIR__ . "/uploads/$senderoId/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadPath = $uploadDir . $originalName;

    if (move_uploaded_file($_FILES['fileGPX']['tmp_name'], $uploadPath)) {
        $response['success'] = true;
        $response['message'] = "Archivo GPX subido con éxito.";
        $response['data']['filePath'] = $uploadPath;
    } else {
        $response['message'] = "Error al subir el archivo.";
    }
} else {
    $response['message'] = "No se proporcionó archivo o identificador de sendero.";
}

echo json_encode($response);
?>