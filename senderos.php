    <div class="container-fluid p-0 m-0">
        <div id="titulo" class="card">
            <button type="button" class="close" aria-label="Cerrar" onclick="cerrarTitulo()">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4>Senderismo y Trekking</h4>
            <h1>Argentina</h1>
            <p>Descubrí los mejores senderos y rutas de trekking de Argentina con nosotros. Desde la inmensidad de la
                Patagonia hasta los picos más altos de los Andes, te ofrecemos mapas detallados y tips para que tu
                próxima aventura sea increíble. ¡Preparate para explorar paisajes únicos y vivir experiencias
                inolvidables en cada caminata!</p>
        </div>
    </div>
    <div id="map"></div>
    <div id="info">Zoom: 13 | Coordenadas: -33.2167, -66.2333</div>
    <div id="positionInfo">Posición X: 0 | Posición Y: 0</div>

    <script>
        var isMobile = window.innerWidth < 768;
        var initialCoordinates = isMobile ? [-34.6037, -58.3816] : [-39.7748, -44.5605];
        var initialZoom = isMobile ? 5 : 4;

        var map = L.map('map').setView(initialCoordinates, initialZoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        const geoJsonFiles = [
            "BUENOSAIRES.json", "CHUBUT.json", "ENTRERIOS.json", "LAPAMPA.json",
            "MISIONES.json", "SALTA.json", "SANTACRUZ.json", "TIERRADELFUEGO.json",
            "CATAMARCA.json", "CORDOBA.json", "FORMOSA.json", "LARIOJA.json",
            "NEUQUEN.json", "SANJUAN.json", "SANTAFE.json", "TUCUMAN.json",
            "CHACO.json", "CORRIENTES.json", "JUJUY.json", "MENDOZA.json",
            "RIONEGRO.json", "SANLUIS.json", "SANTIAGODELESTERO.json"
        ];

        geoJsonFiles.forEach(file => {
    fetch(`./assets/provincias/${file}`)
        .then(response => response.json())
        .then(data => {
            if (data && data.features && data.features.length > 0) {
                var geoJsonLayer = L.geoJSON(data, {
                    style: function (feature) {
                        return { color: '#277527', weight: 2, fillColor: '#277527', fillOpacity: 0.5 };
                    },
                    onEachFeature: (feature, layer) => {
                        layer.on('click', () => {
                            console.log("Click en la capa del archivo:", file);
                            // Asegúrate de que la capa tiene límites definidos y válidos antes de ajustar
                            if (layer.getBounds && layer.getBounds().isValid()) {
                                map.fitBounds(layer.getBounds());
                            } else {
                                console.error('Los límites del archivo no son válidos:', file);
                            }
                        });
                    }
                }).addTo(map);
            } else {
                console.error('El archivo no contiene features válidos:', file);
            }
        })
        .catch(err => console.error('Error loading the GeoJSON file:', file, err));
});


        function updateInfo() {
            var zoomLevel = map.getZoom();
            var center = map.getCenter();
            document.getElementById('info').innerHTML = `Zoom: ${zoomLevel} | Coordenadas: ${center.lat.toFixed(4)}, ${center.lng.toFixed(4)}`;
        }

        map.on('moveend', updateInfo);
        map.on('zoomend', updateInfo);
        updateInfo();

        function cerrarTitulo() {
            document.getElementById('titulo').style.display = 'none';
        }

        window.onload = function() {
            makeDraggable();
        };

        function makeDraggable() {
            var titulo = document.getElementById('titulo');
            var pos1 = 0,
                pos2 = 0,
                pos3 = 0,
                pos4 = 0;

            titulo.onmousedown = dragMouseDown;

            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                titulo.style.top = (titulo.offsetTop - pos2) + "px";
                titulo.style.left = (titulo.offsetLeft - pos1) + "px";
                updatePositionInfo();
            }

            function closeDragElement() {
                document.onmouseup = null;
                document.onmousemove = null;
            }

            function updatePositionInfo() {
                var posX = titulo.offsetLeft;
                var posY = titulo.offsetTop;
                document.getElementById('positionInfo').innerHTML = `Posición X: ${posX} | Posición Y: ${posY}`;
            }
        }
    </script>