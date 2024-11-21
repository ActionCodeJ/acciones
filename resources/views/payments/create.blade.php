@extends('layouts.admin')

@section('title', 'Registrar Pago de Cuota')
@section('content-header', 'Registrar Pago de Cuota')

@section('content')

<div class="card">
    <?php

    //print_r($item);
    $cliente= "Sin cliente";
    $mensaje=  $class= "";
    $cuota=$fecha_pago=  $monto=$order_id=0;
     $item_id=0;
  if (isset($item)) {
      $item_id=$item->id;

      $order_id=$item->order_id;
      $monto=$item->price;
      $cuota=$item->quantity;
      $fecha_pago=$item->fecha_pago;
      $cliente= "Cliente: ".$order->getCustomerName();
      $hoy=date('Y-m-d');

      if($hoy > $fecha_pago ){
        $mensaje= 'Fecha de Pago Vencida: ';
        $class= "alert alert-danger";
       echo '<div class="alert alert-danger" role="alert">';
        echo '<h1 >'.$mensaje.date('d-m-Y', strtotime($fecha_pago )) .' </h1>';
        echo '</div>';
      }else {
        $mensaje=  'faltan  dia/s  para el vncimiento';

      }


  }

 



?>
<div class="alert alert-success" role="alert">
    <h1 >{{$cliente }}  </h1>
	<!-- Log on to marco farfan 3888-15568587 for more projects -->
  

</div>
    <div class="card-body">

              <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
           
            <div class="form-group col-lg-3 col-3">
                <label for="name">{{ __('Fecha del Pago:') }}  </label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $hoy=date('Y-m-d') }}" />
                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
           

            <div class="form-group col-lg-3 col-3">
                <label for="price">Monto</label>
                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount"
                    placeholder="Ingrese Monto" value="{{ old('amount', $monto) }}">
                @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          
            <div class="form-group col-lg-3 col-3">
                <label for="quantity">Numero de Prestamo    </label>
                <input type="text" readonly name="order_id" class="form-control @error('order_id') is-invalid @enderror"
                    id="order_id" placeholder="order_id" value="{{ old('order_id', $order_id) }}">
                @error('order_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-3">
                <label for="quantity"> Numero de Cuota  </label>
                <input type="text" readonly name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                    id="quantity" placeholder="quantity" value="{{ old('quantity', $cuota) }}">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-lg-3 col-3">
                <label for="name">{{ __('Vencimiento:') }}  </label>
                <input type="date" readonly  class="form-control" id="vencimiento" name="vencimiento" value="{{ $fecha_pago}}" />
                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
           
            <div class="form-group col-lg-3 col-3">
                <label for="quantity">Registro de Cuota (Interno) </label>
                <input type="text" readonly name="item_id" class="form-control @error('item_id') is-invalid @enderror"
                    id="item_id" placeholder="item_id" value="{{ old('item_id', $item_id) }}">
                @error('item_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-none">
                <label for="status">Estatus</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                    <option value="1" {{ old('status') === 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{ old('status') === 0 ? 'selected' : ''}}>Inactive</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-success btn-block btn-lg col-lg-4 col-4" type="submit">Registrar Pago de Cuota {{ $cuota}} <i class="nav-icon fas fa-money-bill-wave"></i></button>
        </form><!-- Log on to marco farfan 3888-15568587 for more projects -->
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