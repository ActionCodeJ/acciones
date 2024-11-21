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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Cuentas Asociadas al Ingreso') }}</h1>
                   
                </div>
            </div>
            <div class="card-body">
                
                    
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-info text-black font-weight-bold">Cliente: {{  $user->getFullname()}}</div>
                    </div>
                   


                   
                 

            
                    
                    
                    <div class="form-group col-lg-12 col-8">

                    <table class="table">
                        <thead>
                          <tr>
                            <th colspan="1">Banco </th>
                            <th colspan="1"> Numero </th>
                          
                            <th colspan="1">CBU</th>
                            <th colspan="1">Alias</th>
                          </tr>
                        </thead>
                        <?php 

                        $cantidades=$precios=$productos=null;
                       
                      
                        
                        ?>
                        <tbody>

                            @foreach ($cuentas as $item)
                            <?php 

                               
                                    $clase="table-success";

                               

                               // echo "<br>cantidad:".$cantidad.$clase; 
                            ?>
                            <tr class="table-primary">
                                <td ><label for="name">{{$item->cuenta->id }} - {{$item->cuenta->banco }} </label>
                                    <td ><label for="name">{{ $item->cuenta->numero}}</label>
                               
                                <td ><label for="name"> {{ $item->cuenta->cbu}}</label>
                                    <td class="table-success"><label for="name">   {{ $item->cuenta->alias }}</label>
                              
                               
                            <tr>
                            @endforeach



                        
                        </tbody>
                      </table>
                    </div>
                        <?php ?>
                        <div class="p-3 mb-2 bg-white text-white"></div>
            
                        <td> 
                            <a href="{{ route('cuentas.index') }}" class="btn btn-success"><i
                                class="fas fa-eye"> Volver al Listado de Cuentas de Ingresos</i></a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i> Modificar Cuentas Actuales</a>
                        </td>        </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   
