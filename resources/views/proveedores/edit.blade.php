@extends('layouts.admin')

@section('title', 'Modificar proveedor')
@section('content-header', 'Modificar proveedor')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('proveedores.update', $proveedor) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name"
                           placeholder="First Name" value="{{ old('first_name', $proveedor->first_name) }}">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name"
                           placeholder="Last Name" value="{{ old('last_name', $proveedor->last_name) }}">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                           placeholder="Email" value="{{ old('email', $proveedor->email) }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                           placeholder="Phone" value="{{ old('phone', $proveedor->phone) }}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                           id="address"
                           placeholder="Address" value="{{ old('address', $proveedor->address) }}">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="cuil">cuil</label>
                    <input type="text" name="cuil" class="form-control @error('cuil') is-invalid @enderror"
                           id="cuil"
                           placeholder="cuil" value="{{ old('cuil', $proveedor->cuil) }}">
                    @error('cuil')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="codigoPostal">codigoPostal</label>
                    <input type="text" name="codigoPostal" class="form-control @error('codigoPostal') is-invalid @enderror"
                           id="codigoPostal"
                           placeholder="codigoPostal" value="{{ old('codigoPostal', $proveedor->codigoPostal) }}">
                    @error('codigoPostal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="cuil">ctaBanco</label>
                    <input type="text" name="ctaBanco" class="form-control @error('ctaBanco') is-invalid @enderror"
                           id="ctaBanco"
                           placeholder="ctaBanco" value="{{ old('ctaBanco', $proveedor->ctaBanco) }}">
                    @error('ctaBanco')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="ctaPesos">ctaPesos</label>
                    <input type="text" name="ctaPesos" class="form-control @error('ctaPesos') is-invalid @enderror"
                           id="ctaPesos"
                           placeholder="ctaPesos" value="{{ old('ctaPesos', $proveedor->ctaPesos) }}">
                    @error('ctaPesos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="ctaBonos">ctaBonos</label>
                    <input type="text" name="ctaBonos" class="form-control @error('ctaBonos') is-invalid @enderror"
                           id="ctaBonos"
                           placeholder="ctaBonos" value="{{ old('ctaBonos', $proveedor->ctaBonos) }}">
                    @error('ctaBonos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="codigoBanco">codigoBanco</label>
                    <input type="text" name="codigoBanco" class="form-control @error('codigoBanco') is-invalid @enderror"
                           id="codigoBanco"
                           placeholder="codigoBanco" value="{{ old('codigoBanco', $proveedor->codigoBanco) }}">
                    @error('codigoBanco')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="ingresosBrutosNro">ingresosBrutosNro</label>
                    <input type="text" name="ingresosBrutosNro" class="form-control @error('ingresosBrutosNro') is-invalid @enderror"
                           id="ingresosBrutosNro"
                           placeholder="ingresosBrutosNro" value="{{ old('ingresosBrutosNro', $proveedor->ingresosBrutosNro) }}">
                    @error('ingresosBrutosNro')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gananciasNro">gananciasNro</label>
                    <input type="text" name="gananciasNro" class="form-control @error('gananciasNro') is-invalid @enderror"
                           id="gananciasNro"
                           placeholder="gananciasNro" value="{{ old('gananciasNro', $proveedor->gananciasNro) }}">
                    @error('gananciasNro')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>



                
                <div class="form-group">
                    <label for="cedulaFiscal">cedulaFiscal</label>
                    <input type="text" name="cedulaFiscal" class="form-control @error('cedulaFiscal') is-invalid @enderror"
                           id="cedulaFiscal"
                           placeholder="cedulaFiscal" value="{{ old('cedulaFiscal', $proveedor->cedulaFiscal) }}">
                    @error('cedulaFiscal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <button class="btn btn-success btn-block btn-lg" type="submit">Guardar Cambios</button>
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
