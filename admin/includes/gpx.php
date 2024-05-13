<?php
// Ubicación fija del archivo GPX
$rutaArchivoGPX = '../assets/gpx/5.gpx'; // Asegúrate de cambiar esto por la ruta real del archivo

// Cargar y parsear el archivo GPX si existe
if (file_exists($rutaArchivoGPX)) {
    $contenidoGPX = file_get_contents($rutaArchivoGPX);
    ?>

    <div id="waypoints"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const gpx = new gpxParser();
            gpx.parse(`<?= addslashes($contenidoGPX) ?>`);
            const output = document.getElementById('waypoints');
            output.innerHTML = '<ul>' + gpx.waypoints.map(wp => `<li>${wp.name}: ${wp.lat}, ${wp.lon}</li>`).join('') + '</ul>';
        });
    </script>
    <?php
} else {
    echo "<p>Archivo GPX no encontrado en la ruta especificada.</p>";
}
?>
