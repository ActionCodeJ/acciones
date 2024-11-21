@extends('layouts.admin')

@section('title', 'Datos del Ingresos')

@section('content-header', ' Ingresos')

@section('content-actions')
   <input  class="btn btn-primary  col-lg-3 col-3" type="button" onclick="printDiv('areaImprimir')" value="Imprimir Ingreso" />  <i  class="btn-danger fa-file-pdf-o "></i>
              
   <i class='fas fa-file-pdf' style='font-size:48px;color:red'></i>

   <a href="{{ route('orders.index') }}" class="btn btn-success"><i
    class="fas fa-eye"> Listado de Ingresos</i></a>
<a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i
class="fas fa-edit"></i> Modificar Items Actual</a>

<a href="{{ route('orders.secciones', $order) }}" class="btn btn-secondary"><i
    class="fa fa-braille"></i> Modificar Secciones </a>

@endsection




@section('content')

  <script language="Javascript">

function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var document_html = window.open('_blank');
            document_html.document.write( '<link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css\" type=\"text/css\"/>' );

               
                document_html.document.write( '<link rel=\"stylesheet\" href=\"../css/app.css\" type=\"text/css\"/>' );

               
             document_html.document.write( '<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css\" type=\"text/css\"/>' );
             document_html.document.write( '<link rel=\"stylesheet\" href=\"https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css\" type=\"text/css\"/>' );
           
             document_html.document.write( printContents );
          
             setTimeout(function () {
                   document_html.print();
               }, 500)
}
	</script>
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
           
           

            
            <div class="card-body">
                @if (!empty($order->avatar)) 
                
               
                <td>
                    <img width="200px" class="img-thumbnail" src="{{$order->getAvatarUrl()}}" alt="">
                    <p>Ver Comprobante <a href="{{$order->getAvatarUrl()}}" target="_blank" rel=" Comprobante">Comprobante</a>.</p>

                </td>
                @endif

                <!-- id="seleccion"  para imprimir
                 -->

                <div id="areaImprimir">
                
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">{{ __('Datos registrados en el Ingreso') }}</h1>
                           
                        </div>
        
                     
                     
                    </div>

                    <div class="form-group col-lg-3 col-3">
                        <label for="name">{{ __('Fecha del Ingreso') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $order->fecha) }}" />
                    </div>

                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-danger text-black font-weight-bold">Periodo: {{  $order->periodo}}</div>
                    </div>
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-info text-black font-weight-bold">Cliente: {{  $order->getCustomerName()}}</div>
                    </div>

                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-warning text-black font-weight-bold">Cuenta: {{  $order->cuenta->banco}} - CBU: {{  $order->cuenta->cbu}} - Alias: {{  $order->cuenta->alias}} </div>
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
                        
                <div class="p-3 mb-2 bg-info text-black font-weight-bold">Conceptos / Items</div>
            </div>
                    
                    <div class="form-group col-lg-12 col-8">

                    <table class="table table-primary" >
                        <thead>
                          <tr>
                            <th colspan="3">Concepto - Precio Base </th>
                          
                            <th colspan="3">Cantidad</th>
                            <th colspan="3">Precio Ingresado</th>
                          </tr>
                        </thead>
                        <?php 

                        $cantidades=$precios=$productos=null;
                       
                      
                        
                        ?>
                        <tbody>

                            @foreach ($items as $item)
                            <?php 

                               
                                    $clase="table-success";

                               

                               // echo "<br>cantidad:".$cantidad.$clase; 
                            ?>
                            <tr class="table-primary col-lg-12 col-12">
                                <td colspan="3"><label for="name"> {{$item->product->name }}  - ${{ $item->product->price }}</label>
                               
                                <td colspan="3"><label for="name"> Cantidad: {{ $item->quantity}}</label>
                                    <td colspan="3" class="table-success"><label for="name">   ${{ $item->price }}</label>
                              
                               
                            <tr>
                            @endforeach



                        
                        </tbody>
                      </table>
                    </div>
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-success text-black font-weight-bold">Cuentas</div>
                    </div>
                            
                            <div class="form-group col-lg-12 col-8">
        
                            <table class="table table-primary" >
                                
                                <tbody>
        
                                    @foreach ($cuentas as $cuenta)
                                    <?php
    // print_r($cuenta);

//echo $cuenta->id.$cuenta->numero.$cuenta->banco;
                        $tipo='Cuenta en Pesos'; 
                        $clase = 'table-primary';
                        if($cuenta->cuenta->dolar){
                            $clase = 'table-success';
                            $tipo='Cuenta en DOLARES'; 
                        }

                        $mensaje=''; 
                        
                   if(!empty($cuenta->vencimiento)){
                  
                        $date1 = new DateTime($cuenta->vencimiento);
                            $date2 = new DateTime();
                            $diff = $date1->diff($date2);
                        if( $date2 >=  $date1){
                            $clase = 'table-danger';
                            $mensaje='- Vencido:'.$diff->days . ' dias '; 
                           //   echo $diff->days . ' days '.$mensaje;  
                        }else{
                            
                            // will output 2 days
                            $mensaje='- Faltan '.$diff->days . ' dias ';           
                            $clase = 'table-warning';                    // echo "<br>clase:".$clase;
                        }

                    } 
                      //  echo "<br>mensaje:".$mensaje;
                 ?>
                                    <tr class="<?php echo $clase; ?> col-lg-12 col-12 ">
                                        <td colspan="3"><label for="name"> {{ $cuenta->cuenta->id }}  -  {{ $cuenta->cuenta->banco }} - {{ $cuenta->cuenta->alias }} - {{ $tipo }}</label>
                                       
                                        <td colspan="3"><label for="name">Monto: ${{ $cuenta->monto}}</label>
                                            <td colspan="3" class="table-success"><label for="name">  Cheque: {{ $cuenta->cheque }}</label>
                                                <td colspan="3" class="table-success"><label for="name">Tipo:   {{ $cuenta->tipo_cheque }}</label>
                                                    <td colspan="3" class="table-success"><label for="name"> 
                                                        @if (!empty($cuenta->vencimiento)) 
                                                         {{ date('d-m-Y', strtotime( $cuenta->vencimiento)) }} {{ $mensaje}}
                                                         @endif
                                                        </label>
                                      
                                       
                                    <tr>
                                    @endforeach
        
        
        
                                
                                </tbody>
                              </table>
                            </div>
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-white text-white font-weight-bold"></div>
                    </div>

                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-dark text-white font-weight-bold">Secciones</div>
                    </div>


                    <div class="form-group col-lg-12 col-8">

                        <table class="table table-secondary">
                            <thead>
                              <tr>
                                <th colspan="3">Seccion </th>
                              
                                <th colspan="3">Area</th>
                                <th colspan="3">Finca</th>
                              </tr>
                            </thead>
                           
                            <tbody>
    
                                @foreach ($secciones as $seccion)
                                <?php 
    
                                   
                                        $clase="table-success";
    
                                   
    
                                   // echo "<br>cantidad:".$cantidad.$clase; 
                                ?>
                                <tr class="table-secondary">
                                    <td colspan="3" ><label for="name"> {{ $seccion->id }} -{{ $seccion->seccion->nombre }} </label>
                                        <td colspan="3"><label for="name"> {{ $seccion->seccion->area->nombre }} </label>
                                            <td colspan="3"><label for="name"> {{ $seccion->seccion->area->finca->nombre }}</label>
                                  
                                    
                                   
                                <tr>
                                @endforeach
    
    
    
                            
                            </tbody>
                          </table>
                        </div>
</div>
    <!-- fin impresion -->


                        <?php ?>
                        <div class="p-3 mb-2 bg-white text-white"></div>
            
                        <td> 
                            <a href="{{ route('orders.index') }}" class="btn btn-success"><i
                                class="fas fa-eye"> Volver al Listado de Ordenes de Ingresos</i></a>
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i> Modificar Items Actual</a>

                            <a href="{{ route('orders.secciones', $order) }}" class="btn btn-secondary"><i
                                class="fa fa-braille"></i> Modificar Secciones </a>

                        </td>        </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   
