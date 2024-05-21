<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../App/Config/Database.php';
require_once __DIR__ . '/../../App/Controllers/UserController.php';
require_once __DIR__ . '/../../App/Controllers/admin/MainController.php';

use App\Controllers\UserController;
use App\Controllers\Admin\MainController;

$userController = new UserController();
$mainController = new MainController();

// Obtener la ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath = str_replace('/public/admin/index.php', '', parse_url($requestUri, PHP_URL_PATH));

// Agregar var_dump para verificar las variables clave
var_dump($requestUri);
var_dump($requestMethod);
var_dump($requestPath);

if ($requestPath == '/dashboard' && $requestMethod == 'GET') {
    var_dump("Dashboard route matched");
    $mainController->dashboard();
} elseif ($requestPath == '/users' && $requestMethod == 'GET') {
    var_dump("Users index route matched");
    $userController->index();
} elseif ($requestPath == '/users/create' && $requestMethod == 'GET') {
    var_dump("Users create route matched");
    $userController->create();
} elseif ($requestPath == '/users/store' && $requestMethod == 'POST') {
    var_dump("Users store route matched");
    $userController->store($_POST);
} elseif (preg_match('/\/users\/edit\/(\d+)/', $requestPath, $matches) && $requestMethod == 'GET') {
    var_dump("Users edit route matched");
    $userController->edit($matches[1]);
} elseif (preg_match('/\/users\/update\/(\d+)/', $requestPath, $matches) && $requestMethod == 'POST') {
    var_dump("Users update route matched");
    $userController->update($matches[1], $_POST);
} elseif (preg_match('/\/users\/delete\/(\d+)/', $requestPath, $matches) && $requestMethod == 'POST') {
    var_dump("Users delete route matched");
    $userController->delete($matches[1]);
} else {
    var_dump("404 Not Found");
    echo "404 Not Found";
}
