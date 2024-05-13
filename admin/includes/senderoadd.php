<? ini_set('display_errors', 0); // Turn off error displaying
error_reporting(E_ALL);
?>

<h2>Crear</h2>
<div>
    <ul class="steps">
        <li id="pasoCrear" class="step step-active">
            <div class="step-content">
                <span class="step-circle">1</span>
                <span class="step-text">Crear</span>
            </div>
        </li>
        <li id="pasoGPX" class="step">
            <div class="step-content">
                <span class="step-circle">2</span>
                <span class="step-text">GPX</span>
            </div>
        </li>
        <li id="pasoMetadatos" class="step">
            <div class="step-content">
                <span class="step-circle">3</span>
                <span class="step-text">Metadatos</span>
            </div>
        </li>
        <li id="pasoRevision" class="step">
            <div class="step-content">
                <span class="step-circle">4</span>
                <span class="step-text">Revisión</span>
            </div>
        </li>
    </ul>
    <span id="descripcionPaso">
        <h3>Seleccionar Ubicación</h3>
    </span>
</div>
<form id="formularioSendero" enctype="multipart/form-data">
    <!-- Paso 1 -->
    <div class="form-group">
        <label for="selectProvincia">Provincia</label>
        <select class="form-control select2" id="selectProvincia" name="id_provincia">
            <option value="">Seleccione una provincia</option>
            <!-- Las opciones adicionales se cargarán dinámicamente aquí -->
        </select>
    </div>

    <div class="form-group">
        <label for="selectLocalidad">Localidad</label>
        <select class="form-control select2" id="selectLocalidad" name="id_localidad" disabled>
            <!-- Opciones se cargarán dinámicamente -->

            <option value="">Seleccione primero una provincia</option>
        </select>
    </div>
    <button type="button" class="btn btn-primary" id="botonCrearSendero">Crear Sendero</button>
    <!-- Paso 2 -->
    <div class="form-group" id="contenedorCargaArchivo" style="display: none;">
        <label for="archivoGPX">Archivo GPX</label>
        <input type="file" class="form-control-file" id="archivoGPX">
    </div>
    <button type="button" class="btn btn-primary" id="botonSubirGPX" style="display: none;">Subir GPX</button>


</form>
</div>

</div>
</div>
</section>


</div>