@extends('layouts.admin')

@section('title', ' Pacientes')
@section('content-header', ' Pacientes')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="first_name">Nombre</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                        id="first_name" placeholder="Nombre" value="{{ old('first_name') }}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Apellido</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                        id="last_name" placeholder="Apellido" value="{{ old('last_name') }}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="documento">Dni</label>
                    <input type="number" name="documento" min="9000000" max="99999999"
                        class="form-control col-lg-3 col-3 @error('documento') is-invalid @enderror" id="documento"
                        placeholder="documento" value="{{ old('documento') }}">
                    @error('documento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="cuil">Cuit/Cuil</label>
                    <input type="text" name="cuil" minlength="8" maxlength="13"
                        class="form-control col-lg-3 col-3 @error('cuil') is-invalid @enderror" id="cuil"
                        placeholder="cuil" value="{{ old('cuil') }}">
                    @error('cuil')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Celular</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        id="phone" placeholder="Celular" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="card border-success col-lg-12 col-12">
                    <div class="card-header text-white bg-success mb-3">Direccion personal</div>
                    <div class="card-body text-success">



                        <div class="form-group">
                            <label for="address">Calle</label>
                            <input type="text" name="calle" class="form-control @error('calle') is-invalid @enderror"
                                id="calle" placeholder="Calle" value="{{ old('calle') }}">
                            @error('calle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label for="address">Numero</label>
                            <input type="number" name="numero" min="1" max="99999"
                                class="form-control col-lg-3 col-3 @error('numero') is-invalid @enderror" id="numero"
                                placeholder="Numero" value="{{ old('numero') }}">
                            @error('numero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Barrio</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                id="address" placeholder="Direccion" value="{{ old('address') }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Departamento</label>
                            <input type="text" name="departamento"
                                class="form-control @error('calle') is-invalid @enderror" id="departamento"
                                placeholder="Departamento" value="{{ old('departamento') }}">
                            @error('departamento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Localidad</label>
                            <input type="text" name="localidad"
                                class="form-control @error('localidad') is-invalid @enderror" id="localidad"
                                placeholder="Localidad" value="{{ old('localidad') }}">
                            @error('localidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="card border-secondary col-lg-12 col-12">
                    <div class="card-header text-white bg-secondary mb-3">Obra Social</div>
                    <div class="card-body text-secondary">


                        <div class="form-group">
                            <label for="tipo_comercio">Obra Social</label>
                            <input type="text" name="obra_social"
                                class="form-control @error('obra_social') is-invalid @enderror" id="obra_social"
                                placeholder="Obra Social" value="{{ old('obra_social') }}">
                            @error('obra_social')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>


                <div class="card border-primary col-lg-12 col-12">
                    <div class="card-header text-white bg-primary mb-3">Datos</div>
                    <div class="card-body text-primary">

                        <div class="form-group ">
                            <label for="parentesco_cotitular">Sexo</label>
                            <input type="text" name="sexo"
                                class="form-control @error('sexo') is-invalid @enderror"
                                id="sexo" placeholder="Sexo " value="{{ old('sexo') }}">
                            @error('sexo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>
                </div>

                <button class="btn btn-success btn-block btn-lg" type="submit">Registrar Paciente</button>
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
