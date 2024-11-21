@extends('layouts.admin')

@section('title', ' Listado de Recibos')
@section('content-header', ' Recibos Proximo a Pagar')
@section('content-actions')
    <input  class="btn btn-primary  col-lg-3 col-3" type="button" onclick="printDiv('areaImprimir')" value="Imprimir Listado" />  <i  class="btn-danger fa-file-pdf-o "></i>
              
   <i class='fas fa-file-pdf' style='font-size:48px;color:red'></i>
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
   

  <!-- id="seleccion"  para imprimir
                 -->
 <div id="areaImprimir">      
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 justify-content">{{ __('Listado de La semana') }}</h1>
       
    </div>
<div class="card"><!-- Log on to marco farfan 3888-15568587 for more projects -->
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-12">
                <form action="{{route('orderItems.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Zona</th>
                    <th>Prestamo</th>
                    <th>Cliente</th>
                    <th>Recibo</th>
                    <th>Monto</th>
                    
                    <th>vencimiento</th>
                    <th>Estado</th>
                  
                    
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order->customer->zona}}</td>
                    <td>{{$order->order->codigo}}</td>
                    <td>{{$order->order->getCustomerName()}} - {{$order->order->codigo}}</td>
                    <td>{{$order->quantity}}</td>
                    
                    
                    <td>{{ config('settings.currency_symbol') }} {{$order->price}}</td>
                    <td>
                    
                        {{date('d-m-Y', strtotime($order->fecha_pago )) }}
                    </td>
                    <td>{{$order->estado}}</td>
                    
                    <td> 
                        
                            @if($order->estado =="PAGADO")
                            <a href="{{ route('payments.show', $order->payment_id) }}" class="btn btn-primary"> Ver pago - 
                               <i class="fas fa-money-bill-wave"></i></a>
                
                            @else
                               

                            <a href="{{ route('payments.create', 'id='.$order->id) }}" title="Pagar Cuota" class="btn btn-success">Pagar<i
                            class="fas fa-money-bill-wave"></i></a>

                            @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
            <tfoot><!-- marcofarfan +54 9 3888 56-8587 for more projects -->
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                   <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
</div>
<!-- fin impresion -->

<!--  marcofarfan +54 9 3888 56-8587 for more projects -->
@endsection

