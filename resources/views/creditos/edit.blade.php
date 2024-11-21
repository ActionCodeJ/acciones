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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Modificar Ingreso') }}</h1>
                   
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.update', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-lg-2 col-2">
                        <label for="name">{{ __('Fecha del Ingreso') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $order->fecha) }}" />
                    </div>
                   
                    <div class="form-group">
                        <label for="name">Descripcion del Ingreso</label>
                        <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                            placeholder="Ingrese una descripcion" value="{{ old('descripcion', $order->descripcion) }}">
                        @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="name">Cheque</label>
                        <input type="text" name="cheque" class="form-control @error('cheque') is-invalid @enderror" id="cheque"
                            placeholder="Ingrese el cheque" value="{{ old('cheque', $order->cheque) }}">
                        @error('cheque')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                 

            <div class="form-group col-lg-2 col-2">
                <label for="name">{{ __('Vencimiento') }}</label>
                <input type="date" class="form-control" id="vencimiento" name="vencimiento" value="{{ old('vencimiento', $order->vencimiento) }}" />
            </div>
                    <div class="form-group">
                        <label for="name">{{ __('Seleccione Cliente') }}</label>
                        <select class="form-control " id="customer_id" name="customer_id">
                            <option value="">Seleccione Cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"  {{ $order->customer_id == $customer->id ? 'selected' : '' }}   >{{ $customer->first_name }} {{ $customer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Seleccione Cuenta asociada ') }}</label>
                        <select class="form-control " id="cuenta_id" name="cuenta_id">
                           
                            @foreach ($cuentas as $cuenta)
                                <option value="{{ $cuenta->cuenta->id }}"  {{ $order->cuenta_id == $cuenta->cuenta->id ? 'selected' : '' }}   >{{ $cuenta->cuenta->id }} {{ $cuenta->cuenta->banco }} - CBU: {{  $cuenta->cuenta->cbu}} - Alias: {{  $cuenta->cuenta->alias}} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="name">{{ __('Seleccione Periodo') }}</label>
                        <?php

                        $fecha1=   date("Y")."/". date("Y", strtotime("+1 year"));
                       // echo $fecha1;
                        $periodos[]=$fecha1;
                        $fecha2=   date("Y", strtotime("-1 year")) ."/".date("Y");
                        $periodos[]=$fecha2;
                        $fecha3=   date("Y", strtotime("-2 year")) ."/".date("Y", strtotime("-1 year"));
                        $fecha4=   date("Y", strtotime("-3 year")) ."/".date("Y", strtotime("-2 year"));
                        $fecha5=   date("Y", strtotime("-4 year")) ."/".date("Y", strtotime("-3 year"));
                        $fecha6=   date("Y", strtotime("-5 year")) ."/".date("Y", strtotime("-4 year"));
                        $fecha7=   date("Y", strtotime("-6 year")) ."/".date("Y", strtotime("-5 year"));
                        $fecha8=   date("Y", strtotime("-7 year")) ."/".date("Y", strtotime("-6 year"));
                        $fecha9=   date("Y", strtotime("-8 year")) ."/".date("Y", strtotime("-7 year"));
                        $fecha10=   date("Y", strtotime("-9 year")) ."/".date("Y", strtotime("-8 year"));
                        $fecha11=   date("Y", strtotime("-10 year")) ."/".date("Y", strtotime("-9 year"));
                        $periodos[]=$fecha3;
                        $periodos[]=$fecha4;
                        $periodos[]=$fecha5;
                        $periodos[]=$fecha6;
                        $periodos[]=$fecha7;
                        $periodos[]=$fecha8;
                        $periodos[]=$fecha9;
                        $periodos[]=$fecha10;
                        $periodos[]=$fecha11;
                      
                        ?>
                       



                        <select class="form-control " id="periodo" name="periodo">
                            <option value="$fecha2">Seleccione Periodo por defecto registra {{ $fecha2}} </option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo }}"  {{ $order->periodo == $periodo ? 'selected' : '' }}   >{{ $periodo}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="avatar">Comprobante</label> 
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="avatar" id="avatar">
                            <label class="custom-file-label" for="avatar">Seleccionar comprobante</label>
                        </div>
                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
    

                    <div class="form-group col-lg-12 col-8">

                    <table class="table">
                        <thead>
                          <tr>
                            <th colspan="2">Concepto - Precio Base </th>
                          
                            <th colspan="2">Cantidad</th>
                            <th colspan="2">Precio Ingresado</th>
                          </tr>
                        </thead>
                        <?php 

                        $cantidades=$precios=$productos=null;
                            
                         foreach ($items as $item) {
                            $productos[]=$item->product_id;
                            $precios[]=$item->price;
                            $cantidades[]=$item->quantity;

                           
                        }
                        
                       // print_r($cantidades);
                        
                        ?>
                        <tbody>

                            @foreach ($products as $product)
                            <?php 

                               $precio=$product->price;
                              $cantidad=0;
                              $clase="table-primary";
                                 $key = array_search( $product->id , $productos);
                                 if($key === false){ 
                                   // echo "<br> ".$key."falseee <br>"; 
                                 }else{ 
                                    $cantidad=$cantidades[$key];
                                    $precio=$precios[$key];
                                    $clase="table-success";

                                }

                               // echo "<br>cantidad:".$cantidad.$clase; 
                            ?>
                            <tr class="<?php echo $clase?>">
                                <td ><label for="name"> {{ $product->name }}  - ${{ $product->price }}</label>
                                    <input type="hidden" class="form-control input-number col-lg-4 col-4"  value="{{  $product->id }}" min="0"  id="items.{{ $product->id}}.producto_id" name="productos[]" />
                                </td>
                                    <td class="<?php echo $clase?>" colspan="2"><input type="number" class="form-control input-number col-lg-5 col-5"  value="<?php echo $cantidad?>" min="0" max="100" id="items.{{ $product->id}}.cantidad" name="cantidades[]" /></td>
                                <td><input type="number" class="form-control input-number col-lg-5 col-5"  value="<?php echo $precio?>"  id="items.{{  $product->id }}.precio" name="precio[]" /></td>
                
                            <tr>
                            @endforeach



                        
                        </tbody>
                      </table>
                    </div>
                        <?php ?>
                        
            
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Modificar Ingreso') }}</button>
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