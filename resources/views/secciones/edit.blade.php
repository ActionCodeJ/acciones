@extends('layouts.admin')

@section('title', 'Actualizar seccion')
@section('content-header', 'Actualizar seccion')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('secciones.update', $seccion) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="first_name">Banco</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre"
                           placeholder="nombre Name" value="{{ old('nombre', $seccion->nombre) }}">
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
                           placeholder="descripcion" value="{{ old('descripcion', $seccion->descripcion) }}">
                    @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                

               
                <div class="form-group">
                    <label for="first_name">area</label>
                  
                <select  style="color:#07b4d3;font-size:25px;" id="area_id" name="area_id" class="form-control>
                        @foreach ($areas as $area)
                    
                        
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    
                    @endforeach
            </select>
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
