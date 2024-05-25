<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../App/Config/Database.php';
require_once __DIR__ . '/../../App/Controllers/UserController.php';
require_once __DIR__ . '/../../App/Controllers/admin/MainController.php';
require_once __DIR__ . '/../../App/Controllers/SenderoController.php';
require_once __DIR__ . '/../../App/Controllers/ProvinciaController.php';
require_once __DIR__ . '/../../App/Controllers/LocalidadController.php';

use App\Controllers\UserController;
use App\Controllers\Admin\MainController;
use App\Controllers\SenderoController;
use App\Controllers\ProvinciaController;
use App\Controllers\LocalidadController;

$userController = new UserController();
$mainController = new MainController();
$senderoController = new SenderoController();
$provinciaController = new ProvinciaController();
$localidadController = new LocalidadController();

// Obtener la ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath = str_replace('/public/admin/index.php', '', parse_url($requestUri, PHP_URL_PATH));

// Enrutamiento simple
if (($requestPath == '' || $requestPath == '/dashboard') && $requestMethod == 'GET') {
    $mainController->dashboard();
} elseif ($requestPath == '/users' && $requestMethod == 'GET') {
    $userController->index();
} elseif ($requestPath == '/users/create' && $requestMethod == 'GET') {
    $userController->create();
} elseif ($requestPath == '/users/store' && $requestMethod == 'POST') {
    $userController->store($_POST);
} elseif (preg_match('/\/users\/edit\/(\d+)/', $requestPath, $matches) && $requestMethod == 'GET') {
    $userController->edit($matches[1]);
} elseif (preg_match('/\/users\/update\/(\d+)/', $requestPath, $matches) && $requestMethod == 'POST') {
    $userController->update($matches[1], $_POST);
} elseif (preg_match('/\/users\/delete\/(\d+)/', $requestPath, $matches) && $requestMethod == 'POST') {
    $userController->delete($matches[1]);
} elseif ($requestPath == '/senderos' && $requestMethod == 'GET') {
    $senderoController->index();
} elseif ($requestPath == '/senderos/create' && $requestMethod == 'GET') {
    $senderoController->create();
} elseif ($requestPath == '/senderos/store' && $requestMethod == 'POST') {
    $senderoController->store($_POST);
} elseif (preg_match('/\/senderos\/edit\/(\d+)/', $requestPath, $matches) && $requestMethod == 'GET') {
    $senderoController->edit($matches[1]);
} elseif (preg_match('/\/senderos\/update\/(\d+)/', $requestPath, $matches) && $requestMethod == 'POST') {
    $senderoController->update($matches[1], $_POST);
} elseif (preg_match('/\/senderos\/delete\/(\d+)/', $requestPath, $matches) && $requestMethod == 'POST') {
    $senderoController->delete($matches[1]);
} elseif ($requestPath == '/provincias' && $requestMethod == 'GET') {
    $provinciaController->getAllProvincias();
} elseif ($requestPath == '/localidades' && $requestMethod == 'GET') {
    $provincia_id = $_GET['provincia_id'] ?? null;
    if ($provincia_id) {
        $localidadController->getLocalidadesByProvincia($provincia_id);
    } else {
        echo json_encode(['error' => 'Provincia ID is required']);
    }
} else {
    echo "404 Not Found";
}
