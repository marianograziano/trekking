class TrailRegistration {
    constructor() {
        this.idSendero = null;
        this.initSelectors();
        this.attachEventListeners();
        this.loadProvincias();
        this.initMap();  //

    }

    initSelectors() {
        this.selectProvincia = document.getElementById('selectProvincia');
        this.selectLocalidad = document.getElementById('selectLocalidad');
        this.provincia = document.getElementById('provincia');
        this.localidad = document.getElementById('localidad');
        this.nombreSenda = document.getElementById('nombreSenda');
        this.botonCrearSendero = document.getElementById('botonCrearSendero');
        this.contenedorCargaArchivo = document.getElementById('contenedorCargaArchivo');
        this.archivoGPX = document.getElementById('archivoGPX');
        this.botonSubirGPX = document.getElementById('botonSubirGPX');
        this.formularioMetadatos = document.getElementById('formularioMetadatos');
        this.nombreSenda = document.getElementById('nombreSenda');
        this.descripcionSenda = document.getElementById('descripcionSenda');
        this.botonActualizarGPX = document.getElementById('botonActualizarGPX');
        this.map = document.getElementById('map');
        this.waypointContainer = document.getElementById('waypointContainer');
        this.btnPublicar = document.getElementById('btnPublicar');
    }

    attachEventListeners() {
        this.selectProvincia.addEventListener('change', () => this.loadLocalidades());

        this.selectLocalidad.addEventListener('change', () => this.showPlaces());
     //   this.botonCrearSendero.addEventListener('click', this.crearSendero.bind(this));
      this.botonSubirGPX.addEventListener('click', this.subirGPX.bind(this));
      this.btnPublicar.addEventListener('click', this.publicarSendero.bind(this));
     //   this.botonActualizarGPX.addEventListener('click', this.actualizarMetadatos.bind(this));
    }

    initMap() {
        const mapElement = document.getElementById('map');
        if (!mapElement) {
            console.error('Elemento del mapa no encontrado');
            return;
        }
        this.map = L.map(mapElement, {
            fullscreenControl: true,  // habilitar control de pantalla completa
            fullscreenControlOptions: {  // Opciones de control de pantalla completa
                position: 'topleft',  // posición del botón de pantalla completa
                title: 'Ver mapa en pantalla completa',  // tooltip para el botón expandir
                titleCancel: 'Salir de pantalla completa'  // tooltip para el botón contraer
            }
        }).setView([-34.6037, -58.3816], 10);  // Coordenadas de Buenos Aires
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(this.map);
    
        console.log('Map initialized with fullscreen control', this.map);
    }
    
    
    showPlaces() {

        this.provincia.innerHTML = this.selectProvincia.options[this.selectProvincia.selectedIndex].text;
        this.localidad.innerHTML = this.selectLocalidad.options[this.selectLocalidad.selectedIndex].text;
    }
    loadProvincias() {
       // this.selectProvincia.innerHTML = '<option value="">Cargando provincias...</option>'; // Muestra un mensaje de carga
        console.log('loading provinces');
 
        fetch('includes/load_provincias.php')
            .then(response => {
                    if (!response.ok) {
            //     //    throw new Error(`HTTP error! Status: ${response.status}`);
                     }
                   console.log('Provinces loaded successfully:', response);
                  // console.log('Provinces data:', response.json());
                   return response.json();
            })
            .then(data => {
                console.log('Provinces data:', data);
                if (data.error) {
                    throw new Error(data.error);
                }
                this.selectProvincia.innerHTML = '<option value="">Seleccione una provincia</option>'; // Reset initial option
                data.data.forEach(provincia => {  // Use data.data if data is an object containing the array under a 'data' key
                    var option = new Option(provincia.provincia, provincia.id);

                    this.selectProvincia.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading provinces:', error);
                alert('Error al cargar provincias: ' + error.message);
                this.selectProvincia.innerHTML = '<option value="">Error al cargar</option>'; // Muestra un mensaje de error
            });

        }

    
    

    loadLocalidades() {
        const idProvincia = this.selectProvincia.value;
        this.selectLocalidad.disabled = false;
        this.selectLocalidad.innerHTML = '<option value="">Seleccione una localidad</option>';

        if (idProvincia) {
            fetch(`includes/load_localidades.php?id_provincia=${idProvincia}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(localidad => {
                        var option = new Option(localidad.localidad, localidad.id);
                        this.selectLocalidad.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        } else {
            this.selectLocalidad.disabled = true;
        }
    }

    publicarSendero() {
        const idProvincia = this.selectProvincia.value;
        const idLocalidad = this.selectLocalidad.value;
        const nombreSenda = this.nombreSenda.value;
        const descripcionSenda = this.descripcionSenda.value;

        console.log('Creating trail with province ID:', idProvincia, 'and locality ID:', idLocalidad);
        if (!idProvincia || !idLocalidad) {
            alert('Por favor, seleccione una provincia y una localidad válidas.');
            return;
        }

        fetch('includes/crear_sendero.php', {
            method: 'POST',
            body: JSON.stringify({ id_provincia: idProvincia, id_localidad: idLocalidad, nombre: nombreSenda, descripcion: descripcionSenda}),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(response => response.text())
            .then(response => {
                this.idSendero = response;
                console.log("Sendero creado con ID:", this.idSendero);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al crear el sendero.');
            });
    }

    subirGPX() {
        console.log('subirGPX');
        const file = this.archivoGPX.files[0];
        if (!file) {
            alert('Por favor, seleccione un archivo GPX para subir.');
            return;
        }
        const formData = new FormData();
        formData.append('fileGPX', file);
        formData.append('senderoId', this.idSendero);
    
        fetch('includes/upload_gpx.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(response => {
            console.log("Respuesta recibida:", response);
            if (response.success) {
                console.log("Subida de GPX exitosa.");
                const filePath = response.data.filePath;
                const basePath = "includes";
    
                const relativePath = filePath.substring(filePath.indexOf(basePath));
    
                console.log(relativePath);
                this.actualizaData(relativePath);
    
                // Llamada a la función para mostrar los waypoints y el sendero en el mapa
                this.mostrarMapa(relativePath);
            } else {
                console.error("Error en la subida del GPX:", response.error);
                throw new Error('Falló la subida del archivo GPX: ' + response.error);
            }
        })
        .catch(error => {
            console.error("Error al procesar la respuesta:", error);
            alert('Hubo un error al subir el archivo GPX.');
        });
    }
    
    actualizaData(filePath) {
        
        fetch(filePath)
        .then(response => response.text())
        .then(gpxData => {
            const gpx = new gpxParser();
            gpx.parse(gpxData);
            this.nombreSenda.value = gpx.metadata.name;
            this.descripcionSenda.value = gpx.metadata.desc;
            console.log(gpx.waypoints.map(wp => `- ${wp.name}: ${wp.lat}, ${wp.lon} -`).join(''));
            console.log(gpx.tracks[0].distance.total);
            console.log(gpx.tracks[0].elevation.avg);
            console.log(gpx.tracks[0].elevation.min);
            console.log(gpx.tracks);
            console.log(gpx.metadata.desc);
            console.log(gpx.metadata.link);
        })
        .catch(error => {
            console.error("Error al cargar los datos GPX:", error);
            alert('Hubo un error al cargar los datos GPX.');
        });
    }

    mostrarMapa(gpxPath) {
        // Verificar si el contenedor del mapa y la instancia existen antes de intentar usarlos
        if (!this.map) {
            const mapElement = document.getElementById('map');
            if (!mapElement) {
                console.error('Elemento del mapa no encontrado');
                return;
            }
            this.map = L.map('map').setView([40.0, -3.0], 5);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(this.map);
        } else {
            // Si el mapa ya está inicializado, limpiar todas las capas antes de cargar una nueva
            this.map.eachLayer((layer) => {
                if (!(layer instanceof L.TileLayer)) {
                    this.map.removeLayer(layer);
                }
            });
        }
    
        // Cargar y mostrar el archivo GPX
        new L.GPX(gpxPath, {
            async: true,
            marker_options: {
                startIconUrl: 'includes/uploads/img/icons/start.png',
                endIconUrl: 'includes/uploads/img/icons/end.png',
                shadowUrl: 'includes/uploads/img/icons/shadow.png',
                wptIconUrls: {
                    '': 'includes/uploads/img/icons/pin-icon-wpt.png'
                }
            }
        }).on('loaded', (e) => {
            this.map.fitBounds(e.target.getBounds());
            e.target.getLayers().forEach(layer => {
                if (layer instanceof L.Marker) {
                    layer.bindPopup(`Posición inicial: ${layer.getLatLng()}`);
                    layer.on('click', () => {
                        this.editMarker(layer);
                    });
                }
            });
        }).on('error', (e) => {
            console.error('Error al cargar el archivo GPX:', e.message);
            alert('Error al cargar el archivo GPX.');
        }).addTo(this.map);
    }
    editMarker(marker) {
        // Función para editar marcador
        const iconUrl = prompt("Ingrese la URL del nuevo icono:");
        const newTitle = prompt("Ingrese el nuevo título del marcador:");
        const newDescription = prompt("Ingrese el nuevo texto descriptivo:");
    
        const customIcon = L.icon({
            iconUrl: iconUrl,
            iconSize: [32, 32], // Tamaño del icono
            iconAnchor: [16, 32], // Punto del icono que corresponde a la posición del marcador
            popupAnchor: [0, -32] // Punto donde se abrirá el popup relativo al icono
        });
    
        marker.setIcon(customIcon);
        marker.setPopupContent(`${newTitle}: ${newDescription}`);
    }
    mostrarWaypoints(waypoints) {
        const map = L.map('map').setView([waypoints[0].latitude, waypoints[0].longitude], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    
        waypoints.forEach(wp => {
            let popupContent = `
                <div>
                    <strong>${wp.name}</strong><br>
                    Latitud: ${wp.latitude}<br>
                    Longitud: ${wp.longitude}<br>
                    Time: ${wp.time}<br>
                    <button onclick="editWaypoint('${wp.name}', ${wp.latitude}, ${wp.longitude})">Edit</button>
                    <select onchange="changeSymbol(this.value, '${wp.name}')">`;
    
            symbols.forEach(symbol => {
                popupContent += `<option value="${symbol.icon}">${symbol.name}</option>`;
            });
    
            popupContent += `</select>
                </div>`;
    
            const marker = L.marker([wp.latitude, wp.longitude]).addTo(map);
            marker.bindPopup(popupContent);
        });

        
    }}

