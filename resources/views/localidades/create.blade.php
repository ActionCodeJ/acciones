@extends('layouts.admin')

@section('title', ' Localidades')
@section('content-header', ' Localidades')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('localidades.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="departamento_id">Departamento</label>
                    <select name="departamento_id" class="form-control" required>
                        <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>


             



                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar Localidad</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
