@extends('layouts.admin')

@section('title', 'Configuracion')
@section('content-header', 'Configuracion')

@section('content')
<div class="card"><!-- Log on to marco farfan 3888-15568587 for more projects -->
    <div class="card-body">
        <form action="{{ route('settings.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="app_name">Nombre de la Aplicacion</label>
                <input type="text" name="app_name" class="form-control @error('app_name') is-invalid @enderror" id="app_name" placeholder="App nombre" value="{{ old('app_name', config('settings.app_name')) }}">
                @error('app_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="app_description"> Descripcion</label>
                <textarea name="app_description" class="form-control @error('app_description') is-invalid @enderror" id="app_description" placeholder=" descripcion">{{ old('app_description', config('settings.app_description')) }}</textarea>
                @error('app_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="currency_symbol"> Simbolo de Moneda</label>
                <input type="text" name="currency_symbol" class="form-control @error('currency_symbol') is-invalid @enderror" id="currency_symbol" placeholder="Sinbolo de moneda/Currency symbol" value="{{ old('currency_symbol', config('settings.currency_symbol')) }}">
                @error('currency_symbol')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="warning_quantity">Cantidad de advertencia</label>
                <input type="text" name="warning_quantity" class="form-control @error('warning_quantity') is-invalid @enderror" id="warning_quantity" placeholder="Cantidad de advertencia/Warning quantity" value="{{ old('warning_quantity', config('settings.warning_quantity')) }}">
                @error('warning_quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success btn-block btn-lg"><i class="fas fa-check"></i> Modificar Configuracion</button>
        </form>
    </div>
</div><!-- Log on to marco farfan 3888-15568587 for more projects -->
@endsection
