@extends('layouts.admin')

@section('title', 'Edit Pago de Cuota')
@section('content-header', 'Modificar Pago de Cuota')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('payments.update', $Payment) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group col-lg-3 col-3">
                <label for="name">{{ __('Fecha del Pago:') }}  </label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $Payment->date)}}" />
                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group col-lg-3 col-3">
                <label for="price">Monto</label>
                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount"
                    placeholder="Ingrese Monto" value="{{ old('amount',$Payment->amount) }}">
                @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          
            <div class="form-group col-lg-3 col-3">
                <label for="quantity">Numero de Prestamo    </label>
                <input type="text" readonly name="order_id" class="form-control @error('order_id') is-invalid @enderror"
                    id="order_id" placeholder="order_id" value="{{ old('order_id', $Payment->order_id) }}">
                @error('order_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

           
            
           
            <button class="btn btn-success btn-block btn-lg" type="submit">Actualizar Cambios</button>
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