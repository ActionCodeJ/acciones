@extends('layouts.admin')

@section('title', 'Cuentas Asociadas al Ingresos')





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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Cuentas Asociada al Ingreso') }}</h1>
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">

                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

               
                    <div class="form-group">
                        <div class="form-group">
                        
                            <div class="p-3 mb-2 bg-info text-black font-weight-bold">Usuario: {{  $user->getFullname()}}</div>
                        </div>
                    </div>
                    
                    <?php
$asociadas[]=null;
$cuentaAsociadas = $user->cuentas;
        foreach ($cuentaAsociadas as $key => $valor) {
            // echo $key.'-  cuenta_id :'.$valor->cuenta_id.'<br>';
             $asociadas[]=$valor->cuenta_id;
        }
         // print_r($asociadas);
          
             ?>

                   
                        <div class="form-group">
                            <label for="name">{{ __('Puede Seleccionar  varias Cuenta utilizando el boton Ctrl sostenido y realizando click con el mouse') }}</label>
                            <select class="form-control "    multiple id="cuentas[]" name="cuentas[]" size="10">
                                
                                @foreach ($cuentas as $cuenta)
                                <?php 

                                
                               $cantidad=0;
                               $selected="";
                               $clase="";
                                  $key = array_search( $cuenta->id , $asociadas);
                                  if($key === false){ 
                                    // echo "<br> ".$key."falseee <br>"; 
                                  }else{ 
                                    $selected="selected";
                                     $clase="table-success";
 
                                 }
 
                                // echo "<br>cantidad:".$cantidad.$clase; 
                             ?>


                                    <option class="{{$clase}}"   {{ $selected }}  value="{{ $cuenta->id }}" >{{ $cuenta->id }} -{{ $cuenta->banco }} - CBU: {{ $cuenta->cbu }} - Alias: {{ $cuenta->alias }}</option>
                                @endforeach
                            </select>
                        </div>
                   
                 


            
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Asociar cuentas ingreso') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   
