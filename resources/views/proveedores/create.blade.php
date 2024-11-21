@extends('layouts.admin')

@section('title', ' proveedores')
@section('content-header', ' proveedores')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('proveedores.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="first_name">Nombre</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name"
                           placeholder="Nombre" value="{{ old('first_name') }}">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Apellido</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name"
                           placeholder="Apellido" value="{{ old('last_name') }}">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                           placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Situacion ante el IVA</label>
                    <input type="text" name="iva" class="form-control @error('iva') is-invalid @enderror" id="iva"
                           placeholder="Situacion ante el IVA" value="{{ old('iva') }}">
                    @error('iva')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                           id="address"
                           placeholder="Direccion" value="{{ old('address') }}">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Cuil/CUIT</label>
                    <input type="text" name="cuil" class="form-control @error('cuil') is-invalid @enderror" id="cuil"
                           placeholder="cuil" value="{{ old('cuil') }}">
                    @error('cuil')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="codigoPostal">Codigo Postal</label>
                    <input type="text" name="codigoPostal" class="form-control @error('codigoPostal') is-invalid @enderror" id="codigoPostal"
                           placeholder="codigo Postal" value="{{ old('codigoPostal') }}">
                    @error('codigoPostal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ctaBanco">ctaBanco</label>
                    <input type="text" name="ctaBanco" class="form-control @error('ctaBanco') is-invalid @enderror" id="ctaBanco"
                           placeholder="ctaBanco" value="{{ old('ctaBanco') }}">
                    @error('ctaBanco')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ctaPesos">ctaPesos</label>
                    <input type="text" name="ctaPesos" class="form-control @error('ctaPesos') is-invalid @enderror" id="ctaPesos"
                           placeholder="ctaPesos" value="{{ old('ctaPesos') }}">
                    @error('ctaPesos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ctaBonos">ctaBonos</label>
                    <input type="text" name="ctaBonos" class="form-control @error('ctaBonos') is-invalid @enderror" id="ctaBonos"
                           placeholder="ctaBonos" value="{{ old('ctaBonos') }}">
                    @error('ctaBonos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="codigoBanco">codigo Banco</label>
                    <input type="text" name="codigoBanco" class="form-control @error('codigoBanco') is-invalid @enderror" id="codigoBanco"
                           placeholder="codigoBanco" value="{{ old('codigoBanco') }}">
                    @error('codigoBanco')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">ingresos Brutos</label>
                    <input type="text" name="ingresosBrutos" class="form-control @error('ingresosBrutos') is-invalid @enderror" id="ingresosBrutos"
                           placeholder="ingresosBrutos" value="{{ old('ingresosBrutos') }}">
                    @error('ingresosBrutos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ingresosBrutosNro">ingresos Brutos Nro</label>
                    <input type="text" name="ingresosBrutosNro" class="form-control @error('ingresosBrutosNro') is-invalid @enderror" id="ingresosBrutosNro"
                           placeholder="ingresosBrutosNro" value="{{ old('ingresosBrutosNro') }}">
                    @error('ingresosBrutosNro')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="gananciasNro">ganancias Nro</label>
                    <input type="text" name="gananciasNro" class="form-control @error('gananciasNro') is-invalid @enderror" id="gananciasNro"
                           placeholder="gananciasNro" value="{{ old('gananciasNro') }}">
                    @error('gananciasNro')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cedulaFiscal">cedula Fiscal</label>
                    <input type="text" name="cedulaFiscal" class="form-control @error('cedulaFiscal') is-invalid @enderror" id="cedulaFiscal"
                           placeholder="cedulaFiscal" value="{{ old('cedulaFiscal') }}">
                    @error('cedulaFiscal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cbu">Cbu de la cuenta</label>
                    <input type="text" name="cbu" class="form-control @error('cbu') is-invalid @enderror" id="cbu"
                           placeholder="cbu" value="{{ old('cbu') }}">
                    @error('cbu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alias">Alias de la cuenta</label>
                    <input type="text" name="alias" class="form-control @error('alias') is-invalid @enderror" id="alias"
                           placeholder="alias" value="{{ old('alias') }}">
                    @error('alias')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de cuenta</label>
                    <input type="text" name="tipo" class="form-control @error('tipo') is-invalid @enderror" id="tipo"
                           placeholder="tipo" value="{{ old('alias') }}">
                    @error('tipo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

             
                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar Proveedor</button>
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
