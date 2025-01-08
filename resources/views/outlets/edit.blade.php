@extends('layouts.admin')
@section('title', __('Registar Mapa'))

@section('content')


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     <style> 
        #map { 
          width: 100%; 
          height: 380px; 
          box-shadow: 5px 5px 5px #888; 
        } 
       </style>
       
    <div id="map"></div>
    <script> 
       var latitude = {{$latitude}};
       var longitude = {{$longitude}};
       var mapCenter = 
      
         mapCenter = [latitude , longitude ];

       

       

//var mapCenter = [{{ request('latitude', config('leaflet.map_center_latitude')) }}, {{ request('longitude', config('leaflet.map_center_longitude')) }}];
    var map = L.map('map').setView(mapCenter, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Tu ubicacion :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
        </script>
</body> 



<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header"><i class="fa fa-map-marker text-primary" aria-hidden="true"></i> {{ __('Marcar en el Mapa( Usar el mouse en la imagen del mapa)') }} <i class="fa fa-map-marker text-primary" aria-hidden="true"></i></div>
            <form method="POST" action="{{ route('outlets.update', $outlet) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
           
                <div class="card-body">

                    <label for="name" class="control-label">Actividad: {{ $outlet->action->nombre}}</label>

                   
                    
                  
                    
                   
                    <div class="d-none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="control-label">{{ __('outlet.latitude') }}</label>
                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', $outlet->latitude) }}" required>
                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="control-label">{{ __('outlet.longitude') }}</label>
                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', $outlet->longitude) }}" required>
                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                <div class="card-footer">
                    <input type="submit" value="Actualizar Mapa" class="btn btn-success">
                    <a href="{{ route('actions.show', $outlet->action) }}" class="btn btn-danger">{{ __('Volver') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



<script>
   

   
</script>

