@extends('layouts.auth')
@section('css')

<style>
.login-box,
.register-box {
    width: 660px;
}

    .invalid-feedback {
        display: block
    }

    button {
	border-radius: 20px;
	border: 1px solid #FF4B2B;
	background-color: #FF4B2B;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}
</style>
@section('content')

<p class="login-box-msg">Modificar mis datos en el Sistema</p>
<!-- Log on to marco farfan 3888-15568587 for more projects -->
<form action="{{ route('users.update2', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <div class="form-group">
        
            <div class="p-3 mb-2 bg-info text-black font-weight-bold">Usuario: {{  $user->getFullname()}} - {{  $user->email}}</div>
        </div>
    </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name}}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"  placeholder="Dejar en blanco si NO necesita cambiarla" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row">

                            <label for="password"> <span class="text-white bg-success " >
                                <strong>Atencion !!
                                </strong>
                                </label>
                            <label for="email"> <span class="text-white bg-success " >
                                <strong>(Dejar en blanco si NO necesita cambiarla)
                                </strong>
                                </label>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modificar Datos') }}
                                </button>

                                <a href="{{ route('home') }}" class="btn btn-secondary"> Volver al panel - <i
                                    class="fas fa-home"></i></a>
                            </div>
                        </div>
                </form>
              
@endsection
