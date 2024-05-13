<?php
require __DIR__ . '/../../../vendor/autoload.php'; 
use phpGPX\phpGPX;

// Asume que el ID del sendero y el nombre del archivo están siendo enviados como parte de la solicitud
$senderoId = $_GET['senderoId'] ?? '';
$filename = "./uploads/{$senderoId}-temp.gpx"; // Ruta al archivo GPX

if (!file_exists($filename)) {
    echo json_encode(['success' => false, 'error' => 'Archivo no encontrado']);
    exit;
}

$gpx = new phpGPX();
$file = $gpx->load($filename);

$waypoints = [];
foreach ($file->waypoints as $waypoint) {
    $waypoints[] = [
        'name' => $waypoint->name,
        'latitude' => $waypoint->latitude,
        'longitude' => $waypoint->longitude,
        'time' => $waypoint->time->format(DateTime::ISO8601) // Asegúrate de que la hora es capturada correctamente
    ];
}

echo json_encode(['success' => true, 'waypoints' => $waypoints]);
