@extends('layouts.admin')

@section('title', 'Datos del Creditos')

@section('content-header', ' Creditos')

@section('content-actions')
   <input  class="btn btn-primary  col-lg-3 col-3" type="button" onclick="printDiv('areaImprimir')" value="Imprimir" />  <i  class="btn-danger fa-file-pdf-o "></i>
              
   <i class='fas fa-file-pdf' style='font-size:48px;color:red'></i>

   <a href="{{ route('orders.index') }}" class="btn btn-success"><i
    class="fas fa-eye"> Listado de Creditos</i></a>


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
                        <label for="name">{{ __('Fecha del Credito') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $order->fecha) }}" />
                    </div>

                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-success text-black font-weight-bold">Periodo: {{  $order->periodo}}  - Codigo: {{  $order->codigo}}</div>
                    </div>
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-info text-black font-weight-bold">Cliente: {{  $order->getCustomerName()}} - - Estado: {{  $order->estado}}</div>
                    </div>

                    @if (!empty($order->avatar)) 
                
               
                <td>
                    <img width="200px" class="img-thumbnail" src="{{$order->getAvatarUrl()}}" alt="">
                    <p>Ver Comprobante <a href="{{$order->getAvatarUrl()}}" target="_blank" rel=" Comprobante">Contrato - Pagare</a>.</p>

                </td>
                @endif

                   
            
           
                    <div class="form-group col-lg-12 col-8">

                    <table class="table table-info" >
                        <thead class="thead-dark">
                          <tr>
                            <th colspan="3">Valor Cuota </th>
                          
                            <th colspan="3">Numero</th>
                            <th colspan="3">Vencimiento</th>
                            <th colspan="3"></th>
                          </tr>
                        </thead>
                        <?php 

                        $cantidades=$precios=$productos=null;
                       
                      
                        
                        ?>
                        <tbody>

                            @foreach ($items as $item)
                            <?php 

                                $hoy=date('Y-m-d');
                                $fecha_pago=$item->fecha_pago;
                                if($hoy > $fecha_pago && $item->estado !="PAGADO"){
                                 
                                $mensaje= ' Fecha de Pago Vencida: ';
                                $class= "alert alert-danger";
                                echo '<tr  class="table-primary col-lg-12 col-12">';
                                    echo '<td colspan="12">';
                                    echo '<div class="alert alert-danger" role="alert">';
                                echo '<h1 > Cuota'.$item->quantity.$mensaje.date('d-m-Y', strtotime($fecha_pago )) .' </h1>';
                                echo '</div>';
                                $clase="table-success";
                                 }else {
                                    $mensaje=  'faltan  dia/s  para el vncimiento';

                                }
                                echo '</td>';
                                echo '</tr>';

                               // echo "<br>cantidad:".$cantidad.$clase; 
                            ?>
                            <tr class="table-info col-lg-12 col-12">

                               
                                <td colspan="3"><label for="name">$ {{$item->price }}  </label>
                               
                                <td colspan="3"><label for="name"> Cuota: {{ $item->quantity}}</label>
                                    <td colspan="3" class="table-success"><label for="name">   {{date('d-m-Y', strtotime($item->fecha_pago )) }}</label>
                              
                                        
                            <td>
                                 @if($item->estado =="PAGADO")
                                 <a href="{{ route('payments.show', $item->payment_id) }}" class="btn btn-primary"> Pagado - Ver pago - 
                                    <i class="fas fa-money-bill-wave"></i></a>
                     
                                 @else
                                    
                                        <a href="{{ route('payments.create', 'id='.$item->id) }}" class="btn btn-success"> Pagar Cuota del Prestamo - 
                                            <i class="fas fa-money-bill-wave"></i></a>
                                                 
                                @endif     
                            </td>


                                            
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
                                class="fas fa-eye"> Volver al Listado de Prestamos</i></a>
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i> Modificar Prestamo Actual</a>

                          
                        </td>        </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   
