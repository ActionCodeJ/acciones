@extends('layouts.show')

@section('title', $action->nombre)

@section('content')
    <div class="container mt-5">
        <!-- Tarjeta principal -->
        <div class="card shadow-sm">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header bg-primary text-white">
                <h1 class="card-title mb-0">{{ $action->nombre }}</h1>
            </div>

            <!-- Imagen destacada (la primera del listado), si existe -->
            @if ($action->imagenes->isNotEmpty())
                <img src="{{ asset($imagenes->first()->image_path) }}" alt="Imagen destacada de {{ $action->name }}"
                    class="card-img-top">
            @endif

            <!-- Cuerpo de la tarjeta -->
            <div class="card-body">
                <p class="card-text">{{ $action->descripcion }}</p>

                <!-- Datos generales en fila -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <strong>Localidad:</strong>
                        {{ $action->localidad->nombre }} - {{ $action->localidad->departamento->nombre }}
                    </div>
                    <div class="col-md-4">
                        <strong>Organiza:</strong> {{ $action->entidad->nombre }}
                    </div>
                    <div class="col-md-4">
                        <strong>Fecha:</strong> {{ date('d/m/Y', strtotime($action->fecha)) }}
                    </div>
                </div>

                <!-- Sección de Imágenes (solo si existen) -->
                @if ($action->imagenes->isNotEmpty())
                    <h4 class="mb-3">Imágenes</h4>
                    <div class="row">
                        @foreach ($action->imagenes as $imagen)
                            <div class="col-md-3 col-sm-4 mb-3">
                                <div class="card">
                                    <!-- Enlace que abre la imagen en una nueva pestaña -->
                                    <a href="{{ asset($imagen->image_path) }}" target="_blank">
                                        <img src="{{ asset($imagen->image_path) }}" class="card-img-top"
                                            alt="Imagen de {{ $action->nombre }}">
                                    </a>
                                    <!-- Botón de descarga debajo de la imagen -->
                                    <div class="card-body text-center">
                                        <a href="{{ asset($imagen->image_path) }}" class="btn btn-sm btn-primary"
                                            download="imagen_{{ $loop->iteration }}">
                                            Descargar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Sección de Documentos (solo si existen) -->
                @if ($action->documentos->isNotEmpty())
                    <h4 class="mb-3">Documentos</h4>
                    <ul class="list-group">
                        @foreach ($action->documentos as $documento)
                            <li class="list-group-item">
                                <a href="{{ asset('storage/' . $documento->ruta) }}" target="_blank">
                                    {{ $documento->nombre }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
