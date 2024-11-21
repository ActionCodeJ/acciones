@extends('layouts.admin')



@section('content')
<style>
    /* The container must be positioned relative: */
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element: */
}

.select-selected {
  background-color: DodgerBlue;
}

/* Style the arrow inside the select element: */
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/* Point the arrow upwards when the select box is open (active): */
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/* style the items (options), including the selected item: */
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
}

/* Style items (options): */
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/* Hide the items when the select box is closed: */
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
     </style>

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
    
        <div class="alert alert-success h3 mb-0 text-green-800 justify-content" role="alert">Seguimiento de Tratamientos</div>

        </h1>

    </div>
<div class="card"><!-- Log on to marco farfan 3888-15568587 for more projects -->
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-14">
                <form action="{{route('seguimiento')}}">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-4">
                        <select style="width:350px;" class="custom-select" id="user_id" name="user_id" >
                            <option value="">Todos los Profesionales</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if( request('user_id')  == $user->id) selected="selected" @endif >{{ $user->first_name }} {{ $user->last_name }} - {{ $user->id }}</option>
                            @endforeach
                           
                        </select>
                    </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i>  Buscar </button>
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
                    <th>Fecha</th>
                    <th>Profecional</th>
                    <th>Paciente</th>
                    <th>Entregados</th>
                    <th>Imp. Sup.</th>
                    <th>Imp. Inf.</th>
                    <th>Est. Sup.</th>
                    <th>Est. Inf.</th>
                    <th>Estado</th>
                    <th>Monto</th>
                    <th>Pagado</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>
                        {{date('d/m/Y', strtotime($order->created_at )) }}
                    </td>
                    
                    <td>{{$order->getUserName()}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{$order->alineadores_entregados}}</td>
                    <td>{{$order->alineadores_impresos_sup}}</td>
                    <td>{{$order->alineadores_impresos_inf}}</td>
                    <td>{{$order->alineadores_estampados_sup}}</td>
                    <td>{{$order->alineadores_estampados_inf}}</td>
                   
                   
                      <td>
                        @if($order->estado == "RECHAZADO")
                            <span class="badge badge-danger">{{$order->estado}}</span>
                        @elseif($order->estado == "PENDIENTE")
                            <span class="badge badge-warning">PENDIENTE</span>
                       
                        @elseif($order->estado == "APROBADO") 
                            <span class="badge badge-success">{{$order->estado}}</span>
                        @elseif($order->estado == "ENVIADO") 
                            <span class="badge badge-secundary">{{$order->estado}}</span>

                        @elseif($order->estado == "SOLICITUD  RECIBIDA") 
                            <span class="badge badge-info">{{$order->estado}}</span>


                        @elseif($order->estado == "COTIZACIÓN ENVIADA") 
                            <span class="badge badge-dark">{{$order->estado}}</span>

                        @else
                            <span class="badge badge-primary">{{$order->estado}}</span>
                        @endif
                    </td>
                    <td>{{$order->monto}}</td>
                    <td>{{$order->pagado}}</td>
                    <td> 
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-success" title="Ver Datos"><i
                            class="fas fa-eye"></i></a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary" title="Modificar"><i
                        class="fas fa-edit"></i></a>
                        <a href="{{ route('orders.estado', $order) }}" class="btn btn-secondary"  title="Cambiar Estado"><i class='fas fa-info-circle'></i></a>
    
                           
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

