<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/sidebar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Creación de Sendero</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <form id="trailForm">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="text-primary"><i class="fas fa-map"></i> Creación de Sendero</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="bs-stepper linear">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step active" data-target="#location-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="location-part" id="location-part-trigger" aria-selected="true">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Elegir Provincia y Localidad</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#gpx-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="gpx-part" id="gpx-part-trigger" aria-selected="false" disabled>
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Archivo GPX</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#extra-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="extra-part" id="extra-part-trigger" aria-selected="false" disabled>
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Detalles</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <div id="location-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="location-part-trigger">
                                    <div class="form-group">
                                        <label for="selectProvincia">Provincia</label>
                                        <select class="form-control select2" id="selectProvincia" name="id_provincia">
                                            <option value="">Seleccione una provincia</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="selectLocalidad">Localidad</label>
                                        <select class="form-control select2" id="selectLocalidad" name="id_localidad" disabled>
                                            <option value="">Seleccione primero una provincia</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" id="primerBtnSiguiente">Siguiente</button>
                                </div>
                                <div id="gpx-part" class="content" role="tabpanel" aria-labelledby="gpx-part-trigger">
                                    <div class="form-group" id="contenedorCargaArchivo">
                                        <label for="archivoGPX"><i class="fas fa-map"></i> Archivo GPX</label>
                                        <input type="file" class="form-control-file" id="archivoGPX">
                                        <button type="button" class="btn btn-primary" id="botonSubirGPX">Siguiente</button>
                                        <button class="btn btn-primary" id="btnBack">Volver</button>
                                    </div>
                                </div>
                                <div id="extra-part" class="content" role="tabpanel" aria-labelledby="extra-part-trigger">
                                    <div class="card-header">
                                        <h3 class="card-title">Análisis GPX</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Waypoints</span>
                                                        <span id="cantWaypoints" class="info-box-number text-center text-muted mb-0">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Sendero</span>
                                                        <span id="cantSenderos" class="info-box-number text-center text-muted mb-0">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Rutas</span>
                                                        <span id="cantRutas" class="info-box-number text-center text-muted mb-0">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mailbox-read-info">
                                            <div class="form-group">
                                                <label for="nombreSenda">Nombre del Sendero</label>
                                                <input type="text" id="nombreSenda" name="nombre" class="form-control" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcionSenda">Descripción</label>
                                                <textarea id="descripcionSenda" name="descripcion" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="DuracionSenda">Duración</label>
                                                <div class="input-group">
                                                    <input type="text" id="DuracionSenda" name="duracion" class="form-control" placeholder="Ingrese duración en minutos">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">minutos</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="dificultadSenda">Dificultad</label>
                                                <select id="dificultadSenda" name="dificultad" class="form-control">
                                                    <option value="baja">Baja</option>
                                                    <option value="media">Media</option>
                                                    <option value="alta">Alta</option>
                                                </select>
                                            </div>
                                            <div id="waypointsTableContainer"></div>
                                            <div class="form-group">
                                                <label for="map">Previsualización Mapa</label>
                                                <div id="map" style="height: 400px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-right">
                                            <button type="submit" id="btnPublicar" class="btn btn-primary"><i class="fas fa-check"></i> Publicar</button>
                                        </div>
                                        <button type="button" id="btnDescartar" class="btn btn-default"><i class="fas fa-times"></i> Descartar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const trailRegistration = new TrailRegistration();
    });

    class TrailRegistration {
        constructor() {
            this.idSendero = null;
            this.initSelectors();
            this.attachEventListeners();
            this.loadProvincias();
            this.initSteppers();
        }

        initSteppers() {
            const stepperElement = document.querySelector('.bs-stepper');
            if (stepperElement) {
                window.stepper = new Stepper(stepperElement);
            }
        }

        nextStep() {
            this.stepper.next();
        }

        previousStep() {
            this.stepper.previous();
        }

        initSelectors() {
            this.selectProvincia = document.getElementById('selectProvincia');
            this.selectLocalidad = document.getElementById('selectLocalidad');
            this.archivoGPX = document.getElementById('archivoGPX');
            this.botonSubirGPX = document.getElementById('botonSubirGPX');
            this.primerBtnSiguiente = document.getElementById('primerBtnSiguiente');
            this.btnBack = document.getElementById('btnBack');
            this.btnPublicar = document.getElementById('btnPublicar');
        }

        attachEventListeners() {
            this.selectProvincia.addEventListener('change', this.loadLocalidades.bind(this));
            this.botonSubirGPX.addEventListener('click', this.subirGPX.bind(this));
            this.primerBtnSiguiente.addEventListener('click', this.publicarSendero.bind(this));
            this.btnBack.addEventListener('click', this.previousStep.bind(this));
            this.btnPublicar.addEventListener('click', this.publicarSenderoFinal.bind(this));
        }

        loadProvincias() {
            fetch('/public/admin/index.php/provincias')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    const selectProvincia = document.getElementById('selectProvincia');
                    selectProvincia.innerHTML = '<option value="">Seleccione una provincia</option>';
                    data.data.forEach(provincia => {
                        var option = new Option(provincia.provincia, provincia.id);
                        selectProvincia.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading provinces:', error);
                    alert('Error al cargar provincias: ' + error.message);
                });
        }
        loadLocalidades() {
    const idProvincia = this.selectProvincia.value;
    if (!idProvincia) {
        this.selectLocalidad.innerHTML = '<option value="">Seleccione una provincia primero</option>';
        this.selectLocalidad.disabled = true;
        return;
    }
    this.selectLocalidad.disabled = false;
    fetch(`/public/admin/index.php/localidades?provincia_id=${idProvincia}`)
        .then(response => response.json())
        .then(data => {
            console.log('Localidades data:', data); // Añadir log aquí
            this.selectLocalidad.innerHTML = '<option value="">Seleccione una localidad</option>';
            data.data.forEach(localidad => {
                const option = document.createElement('option');
                option.value = localidad.id;
                option.textContent = localidad.nombre; // Cambiado de localidad.localidad a localidad.nombre
                this.selectLocalidad.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading localidades:', error);
            alert('Error al cargar localidades');
        });
}



        publicarSendero() {
            const idProvincia = this.selectProvincia.value;
            const idLocalidad = this.selectLocalidad.value;

            if (!idProvincia || !idLocalidad) {
                alert('Por favor, seleccione una provincia y una localidad válidas.');
                return;
            }

            fetch('/includes/crear_sendero.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_provincia: idProvincia,
                        id_localidad: idLocalidad
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.idSendero = data.id;
                        this.nextStep();
                    } else {
                        alert('Error al crear el sendero');
                    }
                })
                .catch(error => {
                    console.error('Error creating trail:', error);
                    alert('Error al crear el sendero');
                });
        }

        subirGPX() {
            const file = this.archivoGPX.files[0];

            if (!file) {
                alert('Por favor, seleccione un archivo GPX para subir.');
                return;
            }

            const formData = new FormData();
            formData.append('fileGPX', file);
            formData.append('senderoId', this.idSendero);

            fetch('/includes/upload_gpx.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.mostrarMapa(data.filePath);
                        this.nextStep();
                    } else {
                        alert('Error al subir el archivo GPX');
                    }
                })
                .catch(error => {
                    console.error('Error uploading GPX:', error);
                    alert('Error al subir el archivo GPX');
                });
        }

        mostrarMapa(gpxPath) {
            const map = L.map('map').setView([40.0, -3.0], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            new L.GPX(gpxPath, {
                    async: true
                })
                .on('loaded', function(e) {
                    map.fitBounds(e.target.getBounds());
                })
                .addTo(map);
        }

        publicarSenderoFinal() {
            alert('Sendero publicado exitosamente');
        }
    }
</script>