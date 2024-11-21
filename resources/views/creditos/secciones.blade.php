@extends('layouts.admin')

@section('title', 'Asociar Ingreso  a Secciones')

@section('content-header', 'Ingresos ')


@section('content-actions')

    <a href="{{route('orders.show', $order)}}" class="btn btn-success"><i class="fas fa-finish"></i> Terminar Ingreso sin asociar secciones</a>
@endsection


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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Asociar Secciones al Ingreso  ') }}</h1>
                   
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.agregar', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-lg-2 col-2">
                        <label for="name">{{ __('Fecha del Ingreso') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $order->fecha) }}" />
                    </div>
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-info text-black font-weight-bold">Cliente: {{  $order->getCustomerName()}}</div>
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


                    
            <?php
            $asociadas[]=null;
            $cuentaAsociadas =  $order->secciones;
                    foreach ($cuentaAsociadas as $key => $valor) {
                        // echo $key.'-  seccion_id :'.$valor->seccion_id.'<br>';
                         $asociadas[]=$valor->seccion_id;
                    }
                     // print_r($asociadas);
                      
                         ?>
            
                               
                                    <div class="form-group">
                                        <label for="name">{{ __('Puede Seleccionar  varias Secciones utilizando el boton Ctrl sostenido y realizando click con el mouse') }}</label>
                                        <select class="form-control "    multiple id="secciones[]" name="secciones[]" size="10">
                                            
                                            @foreach ($secciones as $seccion)
                                            <?php 
            
                                            
                                           $cantidad=0;
                                           $selected="";
                                           $clase="";
                                              $key = array_search( $seccion->id , $asociadas);
                                              if($key === false){ 
                                                // echo "<br> ".$key."falseee <br>"; 
                                              }else{ 
                                                $selected="selected";
                                                 $clase="table-success";
             
                                             }
             
                                            // echo "<br>cantidad:".$cantidad.$clase; 
                                         ?>
            
            
                                                <option class="{{$clase}}"   {{ $selected }}  value="{{ $seccion->id }}" >{{ $seccion->id }} -{{ $seccion->nombre }}- Area: {{ $seccion->area->nombre }} - Finca:{{ $seccion->area->finca->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                   
                        <?php ?>
                        
            
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Registrar Secciones al Ingreso') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   
