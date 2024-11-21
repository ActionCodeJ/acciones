@extends('layouts.admin')

@section('title', 'Datos del Pago')

@section('content-header', ' Pago de Cuota')

@section('content-actions')
   <input  class="btn btn-primary  col-lg-3 col-3" type="button" onclick="printDiv('areaImprimir')" value="Imprimir" />  <i  class="btn-danger fa-file-pdf-o "></i>
              
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
               

                <!-- id="seleccion"  para imprimir
                 -->

                <div id="areaImprimir">
                
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">{{ __('Datos registrados en el Pago') }}</h1>
                           
                        </div>
        
                     
                     
                    </div>

                    <div class="form-group col-lg-3 col-3">
                        <label for="name">{{ __('Fecha del Pago') }}</label>
                        <input type="date" class="form-control bg-secondary font-weight-bold" id="fecha" name="fecha" value="{{ old('fecha', $Payment->date) }}" />
                    </div>

                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-success text-black font-weight-bold">Monto: {{  $Payment->amount}}</div>
                    </div>
                    <div class="form-group">
                        
                        <div class="p-3 mb-2 bg-info text-black font-weight-bold">Numero de Prestamo: {{  $Payment->order_id}}</div>
                    </div>

                    
                

                   
            
           
                    
                    
                   
                            
                           
                    

                    
                        
</div>
    <!-- fin impresion -->


                        <?php ?>
                        <div class="p-3 mb-2 bg-white text-white"></div>
            
                        <td> 
                            <a href="{{ route('payments.index') }}" class="btn btn-success"><i
                                class="fas fa-eye"> Volver al Listado de Pagos</i></a>
                            <a href="{{ route('payments.edit', $Payment) }}" class="btn btn-primary"><i
                            class="fas fa-edit"></i> Modificar Pago Actual</a>

                          
                        </td>        </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   