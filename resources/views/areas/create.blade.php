@extends('layouts.admin')

@section('title', ' areas')
@section('content-header', ' areas')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('areas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="first_name">nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre"
                           placeholder="Nombre" value="{{ old('nombre') }}">
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
                           placeholder="descripcion" value="{{ old('descripcion') }}">
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
                           placeholder="ubicacion" value="{{ old('ubicacion') }}">
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
                           placeholder="responsable" value="{{ old('responsable') }}">
                    @error('responsable')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="first_name">Finca</label>
                  
                <select  style="color:#07b4d3;font-size:25px;" id="finca_id" name="finca_id" class="form-control>
                        @foreach ($fincas as $finca)
                    
                        
                            <option value="{{ $finca->id }}">{{ $finca->nombre }}</option>
                    
                    @endforeach
            </select>
        </div>

                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar area</button>
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
