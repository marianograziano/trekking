<?php
session_start();

// Configura la visualización de todos los posibles errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluye las clases UserModel y UserController
require_once 'config/Database.php';
require_once 'models/UserModel.php';
require_once 'controllers/UserController.php';
// Utiliza namespaces de las clases
use Controllers\UserController;
use Models\UserModel;
$postLogin = $_GET["post"];
//var_dump($postLogin);

// Instancia Database, UserModel y UserController
$database = new Database();
$pdo = $database->getConnection();
$userController = new UserController(new UserModel($pdo));

$error = ''; // Inicializar la variable de error

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Intenta autenticar al usuario
    $user = $userController->authenticate($username, $password);


    if ($user) {
        // Si la autenticación es exitosa, almacena la información del usuario en la sesión
        $_SESSION['user'] = $user;
        // Redirige al usuario según su rol
        if ($postLogin == 'admin') {
            header("Location: admin/index.php");
            exit();
        } else 
            { 
            header("Location: index.php");
            exit();
        }
    } else {
        // Si la autenticación falla, muestra un mensaje de error
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html>
<head>


    <style>
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f1f1f1; }
        .login-box { max-width: 400px; width: 100%; }
    </style>
    <?php include 'stylescss.php'; // Asumiendo que este archivo contiene las hojas de estilo ?>

</head>
</head>
<body>
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>S&T.ar Admin</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>
                <!-- Muestra mensaje de error si la autenticación falla -->
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'scriptsjs.php'; // Asumiendo que este archivo contiene los scripts de JS ?>
</body>
</html>