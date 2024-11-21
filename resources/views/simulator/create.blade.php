@extends('layouts.admin')

@section('title', ' Simulador')
@section('content-header', ' Creditos')

@section('content')

    <div class="card">
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="first_name">Monto</label>
                    <input type="number" required id="monto"  name="monto" min="1" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name"
                           placeholder="Monto del credito" value="{{ old('first_name') }}">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Utilidad</label>
                    <select name="utility" class="form-control" id="utility">
                        <option value="0.05">5%</option>
                        <option value="0.1">10%</option>
                        <option value="0.15">15%</option>
                        <option value="0.2">20%</option>
                        <option value="0.25">25%</option>
                        <option value="0.30">30%</option>
                        <option value="0.40">40%</option>
                        <option value="0.50">50%</option>
                    </select>
                </div>

                <div class="form-group">
                    
                    <label for="payment_number">Cuotas:</label>
                                        <select name="payment_number" class="form-control" id="payment_number">
                                            @foreach($payment as $p)
                                                <option value="{{$p->name}}">{{$p->name}}</option>
                                            @endforeach

                                        </select>
                                
                </div>


                <div class="form-group">
                    <label for="first_name">Monto de la cuota Individual</label>
                    <input type="number" id="monto_cuota" name="monto_cuota" step="any" min="1" class="form-control @error('total') is-invalid @enderror"
                           id="first_name"
                           placeholder="Monto del credito" value="">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="first_name">Monto total a Pagar</label>
                    <input type="number" id="total" name="total" min="1" step="any" class="form-control @error('total') is-invalid @enderror"
                           id="first_name"
                           placeholder="Monto del credito" value="">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <a href="customers" class="btn btn-success btn-block btn-lg">

               Registrar Cliente
            </a>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
$('#payment_number').change(function () { 
  // alert($(this).val());
    cuotas= $(this).val();
   monto= $("#monto").val();
  // alert(monto);

   utility = $("#utility").val();
   //alert(utility);
    valor=monto * utility;
    valor= Number(valor.toFixed(2));
    valor_cuota=valor/cuotas;
    valor_cuota = Number(valor_cuota.toFixed(2));
    $("#total").val(valor);
    $("#monto_cuota").val(valor_cuota);
   
   
});

$('#utility').change(function () { 
  // alert($(this).val());
    cuotas= $("#payment_number").val();
   monto= $("#monto").val();
  // alert(monto);

   utility = $("#utility").val();
   //alert(utility);
    valor=monto * utility;
    valor= Number(valor.toFixed(2));
    valor_cuota=valor/cuotas;
    valor_cuota = Number(valor_cuota.toFixed(2));
    $("#total").val(valor);
    $("#monto_cuota").val(valor_cuota);
   
   
});
$('#monto').change(function () { 
  // alert($(this).val());
  cuotas= $("#payment_number").val();
  
   monto= $("#monto").val();
  // alert(monto);

   utility = $("#utility").val();
   //alert(utility);
    valor=monto * utility;
    valor= Number(valor.toFixed(2));


    valor_cuota=valor/cuotas;
    valor_cuota = Number(valor_cuota.toFixed(2));
    $("#total").val(valor);
    $("#monto_cuota").val(valor_cuota);
   
   
});




        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
