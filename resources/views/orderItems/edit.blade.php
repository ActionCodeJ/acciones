@extends('layouts.admin')

@section('title', 'Modificar Prestamo')





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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Modificar Prestamo') }} - {{ $order->codigo }}</h1>
                   
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.update', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4 col-lg-4 col-4 bg-info text-white ">
                        <label for="name">{{ __('Codigo:') }}  </label>
                     
                    <input type="text" readonly id="codigo"  name="codigo"   class="font-weight-bold bg-info text-white @error('codigo') is-invalid @enderror"
                               
                    placeholder="codigo"  value="{{ old('codigo', $order->codigo) }}">
          
                </div>
                    <div class="container">
                        <div class="row">


                            <div class="col-md-6 col-lg-6 col-6">
                                <label for="name">{{ __('Fecha del Ingreso:') }}  </label>
                                    <input type="date" class="form-control col-lg-6 col-6" id="fecha" name="fecha" value="{{ old('fecha', $order->fecha) }}" />
                               
                              </div>


                          <div class="col-md-6 col-lg-6 col-6">
                            <label for="estado">Estado</label>
                            <select name="estado" data-style="btn-primary" class="form-select col-lg-6 col-6  @error('estado') is-invalid @enderror" id="estado">
                                <option value="PENDIENTE" {{$order->estado == 'PENDIENTE' ? 'selected' : ''}}>PENDIENTE</option>
                                <option  style="background-color: rgb(157, 240, 208);"  value="APROBADO" {{ $order->estado === 'APROBADO' ? 'selected' : ''}}>APROBADO</option>
                                <option style="background-color: rgb(245, 114, 105);" value="RECHAZADO" {{ $order->estado === 'RECHAZADO' ? 'selected' : ''}}>RECHAZADO</option>
                                
                            </select>
                            @error('estado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          
                          
                        </div>
                    </div>

              
                  
                   
                    
           
                    <div class="form-group col-md-6 col-lg-6 col-6">
                        <label for="name">{{ __('Seleccione Cliente') }}</label>
                        <select class="form-select " id="customer_id" name="customer_id">
                            <option value="">Seleccione Cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"  {{ $order->customer_id == $customer->id ? 'selected' : '' }}   >{{ $customer->first_name }} {{ $customer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                   


                    <div class="form-group  col-md-4 col-lg-4 col-4">
                        <label for="name">{{ __('Mensual- Semanal') }}</label>
                       
                       



                        <select class="form-control " id="periodo" name="periodo">
                            <option value="Mensual" {{ $order->periodo == "Mensual" ? 'selected' : '' }}>Mensual</option>
                            <option value="Semanal" {{ $order->periodo == "Semanal" ? 'selected' : '' }}>Semanal</option>
                             
                            
                          </select>
                    </div>


                    
                    <div class="form-group  col-md-4 col-lg-4 col-4">
                        <label for="monto">Monto</label>
                        <input type="number" required id="monto"  name="monto" min="10000" max="1500000000"  class="form-control @error('first_name') is-invalid @enderror"
                               
                               placeholder="Monto del credito"  value="{{ old('monto', $order->descripcion) }}">
                        @error('monto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
    
                    <div class="form-group  col-md-4 col-lg-4 col-4">
                        <label for="utility">Interes(%)</label>
                        <input type="number" required id="utility"  name="utility" step="any" min="1" max="150" maxlength="3" size="3" class="form-control @error('utility') is-invalid @enderror"
                              
                               placeholder="Tasa de interes"  value="{{ old('utility', $order->tasa) }}" >
                        @error('utility')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
    
                    <div class="form-group  col-md-4 col-lg-4 col-4">
                        
                        <label for="payment_number">Cuotas:</label>
                                            <select name="payment_number" class="form-control" id="payment_number">
                                                <option value="{{  $order->cuotas }}">{{  $order->cuotas }}  Cuotas </option>
                                                <option value="1">1 Cuotas</option>
                                                <option value="2">2 Cuotas</option>
                                                <option value="3">3 Cuotas</option>
                                                <option value="4">4 Cuotas</option>
                                                <option value="5">5 Cuotas</option>
                                                <option value="6">6 Cuotas</option>
                                                
                                                <option value="7">7 Cuotas</option>
                                                <option value="8">8 Cuotas</option>
                                                <option value="9">9 Cuotas</option>
                                                <option value="10">10 Cuotas</option>
                                                <option value="11">11 Cuotas</option>
                                                <option value="12">12 Cuotas</option>
                                                <option value="13">13 Cuotas</option>
                                                <option value="14">14 Cuotas</option>
                                                <option value="15">15 Cuotas</option>
                                                <option value="16">16 Cuotas</option>
                                                
                                                <option value="17">17 Cuotas</option>
                                                <option value="18">18 Cuotas</option>
                                                <option value="19">19 Cuotas</option>
                                               


                                                <option value="20">20 Cuotas</option>
                                                <option value="21">21 Cuotas</option>
                                                <option value="22">22 Cuotas</option>
                                                <option value="23">23 Cuotas</option>
                                                <option value="24">24 Cuotas</option>
                                                <option value="25">25 Cuotas</option>
                                                <option value="26">26 Cuotas</option>
                                                
                                                <option value="27">27 Cuotas</option>
                                                <option value="28">28 Cuotas</option>
                                                <option value="29">29 Cuotas</option>
                                               
                                            </select>
                                    
                    </div>
                    <?php
                    $monto=$order->monto;
                    $tasa=$order->tasa;
                    $cuotas=$order->cuotas;
                    $monto_cuota=$monto/$cuotas;
                        
                        
                        
                    ?>
    
                    <div class="form-group  col-md-4 col-lg-4 col-4">
                        <label for="first_name">Monto de la cuota Individual</label>
                        <input type="number" id="monto_cuota" name="monto_cuota" step="any" min="1" class="form-control @error('total') is-invalid @enderror"
                               id="first_name"
                               placeholder="Monto del credito" value="{{ old('monto_cuota', $monto_cuota) }}">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    
                        
                    <div class="form-group  col-md-4 col-lg-4 col-4">
                        <label for="first_name">Monto total</label>
                        <input  style="background-color: rgb(210, 247, 247);" type="number" id="credito" name="credito" min="1" step="any" class="form-control @error('total') is-invalid @enderror"
                               id="first_name"
                               placeholder="Monto del credito" value="{{ old('monto', $order->monto) }}">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                   
                        <?php ?>
                        
            
                    <button type="submit" class="btn btn-primary btn-block col-md-4 col-lg-4 col-4">{{ __('Modificar Ingreso') }}</button>
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
    
<script>
    $('#payment_number').change(function () { 
      // alert($(this).val());
        cuotas= $(this).val();
       monto= $("#monto").val();
      // alert(monto);
    
       utility = $("#utility").val();
       //alert(utility);
      
      tasa=utility*cuotas;
        valor=(monto * tasa)/100;
    //alert(tasa);
    //alert(valor);

        valor= Number(valor.toFixed(2));

        
       // $("#total").val(valor);
      //  $("#monto_cuota").val(valor_cuota);
        total=0;
        total += parseFloat(monto)+ parseFloat(valor);

$("#credito").val(total);
valor_cuota=total/cuotas;
        valor_cuota = Number(valor_cuota.toFixed(2));
    //    $("#total").val(valor);
        $("#monto_cuota").val(valor_cuota);
       
    });
    
    $('#utility').change(function () { 
      // alert($(this).val());
        cuotas= $("#payment_number").val();
       monto= $("#monto").val();
      // alert(monto);
    
       utility = $("#utility").val();
       //alert(utility);
       valor=monto * (utility*cuotas);

       tasa=utility*cuotas;
        valor=(monto * tasa)/100;
        valor= Number(valor.toFixed(2));
        valor_cuota=valor/cuotas;
        valor_cuota = Number(valor_cuota.toFixed(2));

      //  $("#total").val(valor);
        $("#monto_cuota").val(valor_cuota);

        total=0;
        total += parseFloat(monto)+ parseFloat(valor);

$("#credito").val(total);
       

    });


    $('#monto').change(function () { 
      // alert($(this).val());
      cuotas= $("#payment_number").val();
      
       monto= $("#monto").val();
      // alert(monto);
    
       utility = $("#utility").val();
       tasa=utility*cuotas;
        valor=(monto * tasa)/100;
       
        valor= Number(valor.toFixed(2));
    
    
      
       
        total=0;
        total += parseFloat(monto)+ parseFloat(valor);

      $("#credito").val(total);
      valor_cuota=total/cuotas;
        valor_cuota = Number(valor_cuota.toFixed(2));
      //  $("#total").val(valor);
        $("#monto_cuota").val(valor_cuota);
       
    });
    
    

        </script>

@endsection