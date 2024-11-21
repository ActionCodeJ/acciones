@extends('layouts.admin')

@section('title', 'Nuevo Tratamiento')





@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <style>


  #progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    /*CSS counters to number the steps*/
    counter-reset: step;
}

#progressbar li {
    list-style-type: none;
    color: white;
    text-transform: uppercase;
    font-size: 9px;
    width: 33.33%;
    float: left;
    position: relative;
    letter-spacing: 1px;
}

#progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 24px;
    height: 24px;
    line-height: 26px;
    display: block;
    font-size: 12px;
    color: #333;
    background: white;
    border-radius: 25px;
    margin: 0 auto 10px auto;
}

/*progressbar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}

#progressbar li:first-child:after {
    /*connector not needed before the first step*/
    content: none;
}

/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #ee0979;
    color: white;
}


/* Not relevant to this form */
.dme_link {
    margin-top: 30px;
    text-align: center;
}
.dme_link a {
    background: #FFF;
    font-weight: bold;
    color: #ee0979;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 5px 25px;
    font-size: 12px;
}

.dme_link a:hover, .dme_link a:focus {
    background: #C5C5F1;
    text-decoration: none;
}
</style>

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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Nuevo Tratamiento') }}</h1>
                    <a href="{{ route('cart.store') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Volver') }}</a>
                </div>
            </div>

            <!-- start step indicators -->
            <ul id="progressbar">
                <li class="active">Personal Details</li>
                <li>Social Profiles</li>
                <li>Account Setup</li>
            </ul>
          
        <!-- end step indicators -->
    
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">


                            <div class="col-md-6 col-lg-6 col-6">
                                <label for="name">{{ __('Fecha del Ingreso:') }}  </label>
                                    <input type="date" class="form-control col-lg-6 col-6" id="fecha" name="fecha" value="{{ $hoy=date('Y-m-d') }}" />
                               
                              </div>


                          <div class="col-md-6 col-lg-6 col-6">
                            <label for="estado">Estado</label>
                            <select name="estado" data-style="btn-primary" class="form-select col-lg-6 col-6  @error('estado') is-invalid @enderror" id="estado">
                                <option value="PENDIENTE" {{ old('estado') == 'PENDIENTE' ? 'selected' : ''}}>PENDIENTE</option>
                                <option  style="background-color: rgb(157, 240, 208);"  value="APROBADO" {{ old('estado') === 'APROBADO' ? 'selected' : ''}}>APROBADO</option>
                                <option style="background-color: rgb(245, 114, 105);" value="RECHAZADO" {{ old('estado') === 'RECHAZADO' ? 'selected' : ''}}>RECHAZADO</option>
                                
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
                        <select class="form-select " id="customer_id" name="customer_id" required>
                            <option value="">Seleccione Cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }} - {{ $customer->id }}</option>
                            @endforeach
                        </select>
                    </div>


                  
                    <div class="form-group col-md-4 col-lg-4 col-4">
                        <label for="last_name">Maxilares</label>
                        <select name="periodo" class="form-select" id="periodo">
                            <option value="Mensual">Superior</option>
                            <option value="Semanal">Inferior</option>
                            <option value=" Ambos maxilares"> Ambos maxilares</option>
                          
                        </select>
                    </div>
    
                    <div class="form-group col-md-8 col-lg-8 col-8">
    
                        <button type="button" class="btn btn-outline-primary">Tratamiento Short
                        </button>
                        <button type="button" class="btn btn-outline-secondary">Tratamiento Medium</button>
                        <button type="button" class="btn btn-outline-success">Tratamiento Large</button>
                        <button type="button" class="btn btn-outline-danger">Danger</button>
                        <button type="button" class="btn btn-outline-warning">Warning</button>
                        <button type="button" class="btn btn-outline-info">Info</button>
                       

</div>

            
                    <button type="submit" class="btn btn-primary btn-block col-md-4 col-lg-4 col-4">{{ __('Registrar Nuevo Tratamiento') }}</button>
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