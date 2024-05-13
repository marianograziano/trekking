<?php

session_start();

ini_set('display_errors', 0); // Turn off error displaying
error_reporting(E_ALL);
// var_dump(__FILE__);
// var_dump($_SESSION);
if (isset($_SESSION['user'])) {

  $usuario_json = json_encode($_SESSION['usuario']);
  echo "<script>console.log('Datos del usuario: ', $usuario_json);</script>";
} else {
  header('Location: /../login.php?post=admin');
  exit;  
}

$page = isset($_GET["page"]) ? $_GET["page"] : 'landing';

?>
<!DOCTYPE html>

<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Senderos y Trekking - Admin</title>
  <!-- Fuente de Google y Font Awesome -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Estilos de AdminLTE y otros plugins -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-steps@%5E1.0/dist/bootstrap-steps.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />

<style>
.leaflet-control-fullscreen {
    display: block !important; /* Asegura que el botón esté visible */
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 1000 !important; /* Asegura que esté por encima de otros elementos */
}

/* Verificar si el contenedor del mapa está limitando la visibilidad */

</style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

  <?php 
    include "modules/navbar.php"
    ?>
    
    <?php 
    include "modules/aside.php"
    ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $page ?> Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active"><?= $page ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
<!-- empieza content dinamico -->
    <?php 
    
    include_once 'includes/' . $page . '.php';
    ?>
  </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  </div>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.5.0/gpx.min.js"></script>
  <script src="https://unpkg.com/gpxparser"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <script src="includes/trailRegistration.js"></script>
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Inicialización de la clase cuando el DOM esté completamente cargado -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const trailRegistration = new TrailRegistration();
    });
  </script>
</body>
</html>

</html>