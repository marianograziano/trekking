<div style="display: flex; flex-wrap: wrap;"> <!-- Contenedor flexbox para alinear secciones horizontalmente -->
    <section class="content" style="flex: 1; min-width: 50%; max-width: 50%;"> <!-- Asegura que cada sección ocupe la mitad del espacio -->
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
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



                    <div class="form-group" id="contenedorCargaArchivo">
                        <label for="archivoGPX"><i class="fas fa-map"></i> Archivo GPX</label>
                        <input type="file" class="form-control-file" id="archivoGPX">
                        <td class="project-state">
                            <span class="badge badge-success" style="display: none" ;>Sin procesar</span>
                        </td>
                        <button type="button" class="btn btn-primary" id="botonSubirGPX">Subir GPX</button>
                        <button type="button" class="btn btn-primary" id="botonProcesarGPX">Procesar GPX</button>
                    </div> <!-- Contenido del cuerpo de la tarjeta aquí -->
                </div>
            </div>

        </div>

    </section>

    <section class="content" style="flex: 1; min-width: 50%; max-width: 50%;">
        <div class="col-md-12">
        <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Previsualización</h3>
    </div>
    <div class="card-body">
        <div class="mailbox-read-info">
            <div class="form-group">
                <label for="nombreSenda">Nombre de la Senda</label>
                <input type="text" id="nombreSenda" class="form-control" value="">
            </div>

            <h6><span id="provincia"></span> - <span id="localidad"></span></h6>
            <div class="form-group">
                <label for="descripcionSenda">Descripción</label>
                <textarea id="descripcionSenda" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="DuracionSenda">Duración</label>
                <div class="input-group">
                    <input type="text" id="DuracionSenda" class="form-control" placeholder="Ingrese duración en minutos">
                    <div class="input-group-append">
                        <span class="input-group-text">minutos</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="dificultadSenda">Dificultad</label>
                <select id="dificultadSenda" class="form-control">
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                </select>
            </div>

            <div class="form-group">
                <label for="map">Previsualización Mapa</label>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-right">
            <button type="button" id="btnBorrador" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Borrador</button>
            <button type="button" id="btnPublicar" class="btn btn-primary"><i class="fas fa-check"></i> Publicar</button>
        </div>
        <button type="button" id="btnDescartar" class="btn btn-default"><i class="fas fa-times"></i> Descartar</button>
    </div>
</div>

    </section>
</div>
</div>