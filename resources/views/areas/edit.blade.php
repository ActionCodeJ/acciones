@extends('layouts.admin')

@section('title', 'Modificar area')
@section('content-header', 'Modificar area')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('areas.update', $area) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="first_name">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre"
                           placeholder="nombre Name" value="{{ old('nombre', $area->nombre) }}">
                    @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">descripcion</label>
                    <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                           id="descripcion"
                           placeholder="descripcion" value="{{ old('descripcion', $area->descripcion) }}">
                    @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="first_name">ubicacion</label>
                    <input type="text" name="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror"
                           id="ubicacion"
                           placeholder="ubicacion Name" value="{{ old('ubicacion', $area->ubicacion) }}">
                    @error('ubicacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="first_name">responsable</label>
                    <input type="text" name="responsable" class="form-control @error('responsable') is-invalid @enderror"
                           id="responsable"
                           placeholder="responsable Name" value="{{ old('responsable', $area->responsable) }}">
                    @error('responsable')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                

               

               


                <button class="btn btn-success btn-block btn-lg" type="submit">Guardar cambios</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
