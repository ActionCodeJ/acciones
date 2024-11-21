@extends('layouts.admin')

@section('title', ' Cuentas')
@section('content-header', ' Cuentas')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('cuentas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="first_name">Banco</label>
                    <input type="text" name="banco" class="form-control @error('banco') is-invalid @enderror"
                           id="banco"
                           placeholder="Nombre" value="{{ old('banco') }}">
                    @error('banco')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Numero</label>
                    <input type="text" name="numero" class="form-control @error('numero') is-invalid @enderror"
                           id="numero"
                           placeholder="numero" value="{{ old('numero') }}">
                    @error('numero')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Cbu</label>
                    <input type="text" name="cbu" class="form-control @error('cbu') is-invalid @enderror" id="cbu"
                           placeholder="cbu" value="{{ old('cbu') }}">
                    @error('cbu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">alias</label>
                    <input type="text" name="alias" class="form-control @error('alias') is-invalid @enderror" id="alias"
                           placeholder="alias" value="{{ old('alias') }}">
                    @error('alias')
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
                    <label for="last_name">Cuenta en Pesos o Dolares</label>
                <select class="form-control " id="dolar" name="dolar">
                    <option value="0">Cuenta en Pesos </option>
                    <option class="btn-success "   value="1">Cuenta en Dolares </option>
                </select>

            </div>
            <div class="form-group">
             

        </div>

                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar cuenta</button>
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
