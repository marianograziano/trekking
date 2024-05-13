<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', '0');
ini_set('default_charset','UTF-8');

if (isset($_SESSION['user'])) {
    // Convertir los datos del usuario a formato JSON para pasarlos a JavaScript
    $usuario_json = json_encode($_SESSION['user']);
    echo "<script>console.log('Datos del usuario: ', $usuario_json);</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trekking y Senderismo</title>
    <?php include 'stylescss.php'; // Asumiendo que este archivo contiene las hojas de estilo ?>
    <?php include 'scriptsjs.php'; // Asumiendo que este archivo contiene los scripts de JS ?>
</head>
<body>
    <?php
    include 'layout/navigation.php'; // Barra de navegación
    require_once 'config/Database.php';
    require_once 'models/UserModel.php';
    require_once 'controllers/UserController.php';

    // Utiliza namespaces de las clases
    use Controllers\UserController;
    use Models\UserModel;

    // Instanciar tu modelo y controlador
    $database = new Database();
    $pdo = $database->getConnection();
    $userModel = new UserModel($pdo);
    $userController = new UserController($userModel);

    include 'senderos.php'; // Contenido principal de senderos

    ?>
</body>
</html>