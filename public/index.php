<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar el autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';


// Mensaje de prueba para asegurar que el archivo index.php se carga correctamente
echo 'Archivo index.php cargado correctamente.<br>';

// Función simple para manejar rutas
function route($uri, $callback) {
    if ($_SERVER['REQUEST_URI'] == $uri) {
        $callback();
    }
}

// Definir una ruta básica
route('/', function() {
    $controller = new \App\Controllers\HomeController();
    $controller->index();
});

// Ejemplo de uso de la clase Database
try {
    $db = new \App\Config\Database();
    $conn = $db->getConnection();
    echo 'Conexión a la base de datos establecida correctamente.<br>';
} catch (Exception $e) {
    echo 'Error en la conexión a la base de datos: ' . $e->getMessage();
}
