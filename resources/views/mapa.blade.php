<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="documents/ACUERDO DE TRATAMIENTO FASE 1.pdf">ACUERDO DE TRATAMIENTO FASE 1</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>

                <style>
                    .text-center {
                        text-align: center;
                    }
                    #map {
                        width: '100%';
                        height: 600px;
                    }
                </style>
                <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
            </head>
            
            <body>
                <h1 class='text-center'>Laravel Leaflet Maps

                    <?php //echo json_encode($initialMarkers); ?>
                </h1>
                <div id='map'></div>
            
                <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
                <script>
                    let map, markers = [];
                    /* ----------------------------- Initialize Map ----------------------------- */
                    function initMap() {
                        map = L.map('map', {
                            center: {
                                lat: {{ config('leaflet.map_center_latitude') }},
                                lng: {{ config('leaflet.map_center_longitude') }},
                            },
                            zoom: 15
                        });
            
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        
            
                        map.on('click', mapClicked);
                        initMarkers();
                    }
                    initMap();

var circle = L.circle([ -24.24317183888, -65.22973307560], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 800
}).addTo(map);
              
var circle = L.circle([-24.26732188955, -65.21053895260], {
    color: 'green',
    fillColor: 'green',
    fillOpacity: 0.5,
    radius: 800
}).addTo(map);
var polygon = L.polygon([
    [-24.24, -65.20],
    [-24.254, -65.21324162],
    [-24.254, -65.22324162],
]).addTo(map);


var theMarker;

map.on('click', function(e) {
    let latitude = e.latlng.lat.toString().substring(0, 15);
    let longitude = e.latlng.lng.toString().substring(0, 15);

    if (theMarker != undefined) {
        map.removeLayer(theMarker);
    };

    var popupContent = "Tu locacion : " + latitude + ", " + longitude + ".";
    popupContent += '<br><a href="{{ route('outlets.create') }}?latitude=' + latitude + '&longitude=' + longitude + '">Deseas agregar una nueva marca aqui??</a>';

    theMarker = L.marker([latitude, longitude]).addTo(map);
    theMarker.bindPopup(popupContent)
    .openPopup();
});
                    /* --------------------------- Initialize Markers --------------------------- */
                    function initMarkers() {
                        const initialMarkers = <?php echo json_encode($initialMarkers); ?>;
            
                        for (let index = 0; index < initialMarkers.length; index++) {
            
                            const data = initialMarkers[index];
                            const marker = generateMarker(data, index);
                            marker.addTo(map).bindPopup(`<b>${data.position.dato},${data.position.lat},  ${data.position.lng}</b>`);
                            map.panTo(data.position);
                            markers.push(marker)
                        }
                    }
            
                    function generateMarker(data, index) {
                        return L.marker(data.position, {
                                draggable: data.draggable
                            })
                            .on('click', (event) => markerClicked(event, index))
                            .on('dragend', (event) => markerDragEnd(event, index));
                    }
                   
                    /* ------------------------- Handle Map Click Event ------------------------- */
                    function mapClicked($event) {
                        console.log(map);
                        console.log($event.latlng.lat, $event.latlng.lng);
                    }
            
                    /* ------------------------ Handle Marker Click Event ----------------------- */
                    function markerClicked($event, index) {
                        console.log(map);
                        console.log($event.latlng.lat, $event.latlng.lng);
                    }
            
                    /* ----------------------- Handle Marker DragEnd Event ---------------------- */
                    function markerDragEnd($event, index) {
                        console.log(map);
                        console.log($event.target.getLatLng());
                    }
                </script>
            </body>
            
            </div>
        </div>
    </body>
</html>
