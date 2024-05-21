<?php

namespace App\Controllers\Admin;

class MainController {
    public function dashboard() {
        // Calcula la ruta al archivo dashboard.php
        $path = dirname(__DIR__, 2) . '/Views/admin/dashboard.php';
        
        // Imprime la ruta para depuración
        echo "Ruta calculada: $path<br>";

        // Incluye el archivo dashboard.php
        include $path;
    }
}
