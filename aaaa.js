// Inicializar el mapa
const map = L.map('map').setView([-41.1334722, -71.3102778], 13); // Coordenadas iniciales, cambiarán

const startIcon = new L.Icon({
    iconUrl: 'img/icons/start.png',
    iconSize: [16, 16], // Tamaño del icono
    iconAnchor: [8, 16], // Punto del icono que corresponde a la ubicación del marcador
    popupAnchor: [0, -16] // Punto desde el cual se mostrará el popup relativo al iconAnchor
});

const endIcon = new L.Icon({
    iconUrl: 'img/icons/end.png',
    iconSize: [16, 16],
    iconAnchor: [8, 16],
    popupAnchor: [0, -16]
});


// Añadir capa base
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Crear un objeto LatLngBounds para ajustar los límites del mapa
let bounds = new L.LatLngBounds();

// Función para cargar y añadir un sendero GPX al mapa
// Función para cargar y añadir un sendero GPX al mapa
function addGPXToMap(file) {
    const gpxPath = `/senderos/${file}`;
    new L.GPX(gpxPath, {
        async: true,
        marker_options: {
            startIcon: startIcon,
            endIcon: endIcon,
            shadowUrl: null,
            wptIconUrls: {
                //'': 'img/icons/pin-icon-wpt.png'  // Ruta modificada del icono de waypoint
            '': null,
            }},

        polyline_options: {
            color: 'blue', // Color del sendero
            opacity: 0.75,
            weight: 5
        }
    }).on('loaded', function(e) {
        // Extender los límites del mapa con los límites del sendero cargado
        bounds.extend(e.target.getBounds());
        // Ajustar la vista del mapa para que incluya todos los senderos cargados
        map.fitBounds(bounds);
    }).on('click', function(e) {
        // Extraer el nombre base del archivo sin la extensión
        const baseName = file.replace('.gpx', '');
        const popupContent = `<b>${baseName}</b><br><a href='/senderos/${baseName}.html' target="_parent">Visitar página del sendero</a>`;
        const popup = L.popup()
            .setLatLng(e.latlng) // establece la ubicación del popup en el punto donde se hizo clic
            .setContent(popupContent) // establece el contenido HTML del popup
            .openOn(map); // abre el popup en el mapa
    }).addTo(map);
}



// Obtener lista de archivos GPX del servidor
fetch('get_gpx_files.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Respuesta de red no fue ok');
        }
        return response.json();
    })
    .then(files => {
        if (files.error) {
            console.error('Error desde el servidor:', files.error);
            return;
        }
        files.forEach(file => {
            addGPXToMap(file);
        });
    }).catch(error => {
        console.error('Fallo en la solicitud:', error);
    });
