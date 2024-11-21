@extends('layouts.admin')

@section('title', 'Modificar Ingresos')





@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  
  <div class="container-fluid">

    <!-- Page Heading -->
    

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Agregar Pagos al Ingreso') }}</h1>
                   
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.agregarCuentas', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-lg-2 col-2">
                        <label for="name">{{ __('Fecha del Ingreso') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $order->fecha) }}" />
                    </div>
                   
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-success text-black font-weight-bold">Periodo: {{  $order->periodo}}</div>
                    </div>
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-info text-black font-weight-bold">Cliente: {{  $order->getCustomerName()}}</div>
                    </div>

                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-warning text-black font-weight-bold">Descripcion: {{  $order->descripcion}}</div>
                    </div>


                       



                        
    

                    <div class="form-group col-lg-12 col-12">

                    <table class="table">
                        
                        <?php

                       

                       

                       //  print_r($cuentas);

                        ?>
                        <tbody>

                            @foreach ($cuentas as $cuenta)
                            <?php
    // print_r($cuenta);

//echo $cuenta->id.$cuenta->numero.$cuenta->banco;
                        $tipo='Cuenta en Pesos'; 
                        $clase = 'table-primary';
                        if($cuenta->cuenta->dolar){
                            $clase = 'table-danger';
                            $tipo='Cuenta en DOLARES'; 
                        }
                                    
                   //  echo "<br>tipo:".$tipo;
                    // echo "<br>clase:".$clase;
                        ?>
                            <tr class="<?php echo $clase; ?>">
                                <td ><label for="name">{{ $cuenta->cuenta->id }}  -  {{ $cuenta->cuenta->banco }} - {{ $cuenta->cuenta->alias }} - {{ $tipo }}</label>
                                    <input type="hidden" class="form-control input-number"  value="{{  $cuenta->cuenta->id }}" min="0"  id="items.{{ $cuenta->cuenta->id}}.cuenta_id" name="productos[]" />
                                </td>
                                <td>Monto:<input type="input" class="form-control input-number col-lg-8 col-8"   id="items.{{  $cuenta->cuenta->id }}.precio" name="precio[]" /></td>
                                    <td>Cheque:<input type="input" class="form-control input-number col-lg-8 col-8"   id="items.{{  $cuenta->cuenta->id }}.cheque" name="cheque[]" /></td>
                                        <td>Tipo de cheque<input type="input" class="form-control input-number col-lg-8 col-8"   id="items.{{  $cuenta->cuenta->id }}.tipo" name="tipo[]" /></td>
                                            <td>Vencimiento:<input type="date" class="form-control input-number col-lg-10 col-10"   id="items.{{  $cuenta->cuenta->id }}.vencimiento" name="vencimiento[]" /></td>


                            <tr>
                            @endforeach



                        
                        </tbody>
                      </table>
                    </div>
                        <?php ?>
                        
            
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Agregar Cuentas al Ingreso') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

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