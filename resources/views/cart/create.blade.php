@extends('layouts.admin')

@section('title', 'Nuevo Tratamiento')





@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  
  <style>
/* style.css */
.my-class-form-control-group{
  display:flex;
  align-items:Center;
}
.container .steps {
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: space-between;
  position: relative;
}
.steps .circle {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 50px;
  width: 50px;
  color: #999;
  font-size: 22px;
  font-weight: 500;
  border-radius: 50%;
  background: #fff;
  border: 4px solid #e0e0e0;
  transition: all 200ms ease;
  transition-delay: 0s;
}
.steps .circle.active {
  transition-delay: 100ms;
  border-color: #4070f4;
  color: #4070f4;
  background: #fff;
}
.steps .progress-bar {
  position: absolute;
  height: 4px;
  width: 100%;
  background: #4070f4;
  z-index: -0;/* ver linea  -1 ocultra*/
}
.progress-bar .indicator {
  position: absolute;
  height: 100%;
  width: 0%;
  background: #4070f4;
  transition: all 300ms ease;
}


/****/
.step-wizard {
    background-color: #21d4fd;
    background-image: linear-gradient(19deg, #21d4fd 0%, #b721ff 100%);
    height: 23vh;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.step-wizard-list{
    background: #fff;
    box-shadow: 0 15px 25px rgba(0,0,0,0.1);
    color: #333;
    list-style-type: none;
    border-radius: 10px;
    display: flex;
    padding: 20px 10px;
    position: relative;
    z-index: 10;
}

.step-wizard-item{
    padding: 0 20px;
    flex-basis: 0;
    -webkit-box-flex: 1;
    -ms-flex-positive:1;
    flex-grow: 1;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    text-align: center;
    min-width: 170px;
    position: relative;
}
.step-wizard-item + .step-wizard-item:after{
    content: "";
    position: absolute;
    left: 0;
    top: 19px;
    background: #21d4fd;
    width: 100%;
    height: 2px;
    transform: translateX(-50%);
    z-index: -10;
}
.progress-count{
    height: 40px;
    width:40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-weight: 600;
    margin: 0 auto;
    position: relative;
    z-index:10;
    color: transparent;
}
.progress-count:after{
    content: "";
    height: 40px;
    width: 40px;
    background: #21d4fd;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    z-index: -10;
}
.progress-count:before{
    content: "";
    height: 10px;
    width: 20px;
    border-left: 3px solid #fff;
    border-bottom: 3px solid #fff;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -60%) rotate(-45deg);
    transform-origin: center center;
}
.progress-label{
    font-size: 14px;
    font-weight: 600;
    margin-top: 10px;
}
.current-item .progress-count:before,
.current-item ~ .step-wizard-item .progress-count:before{
    display: none;
}
.current-item ~ .step-wizard-item .progress-count:after{
    height:10px;
    width:10px;
}
.current-item ~ .step-wizard-item .progress-label{
    opacity: 0.5;
}
.current-item .progress-count:after{
    background: #fff;
    border: 2px solid #21d4fd;
}
.current-item .progress-count{
    color: #21d4fd;
}
</style>
<!-- start step indicators -->

<section class="step-wizard">
    <ul class="step-wizard-list">
        <li class="step-wizard-item">
            <span class="progress-count">1</span>
            <span class="progress-label">Datos Personales</span>
        </li>
        <li class="step-wizard-item current-item">
            <span class="progress-count">2</span>
            <span class="progress-label">Tratamiento</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">3</span>
            <span class="progress-label">Imagenes</span>
        </li>
        <li class="step-wizard-item">
            <span class="progress-count">4</span>
            <span class="progress-label">Documentacion</span>
        </li>
    </ul>
</section>
  <!-- barra basica cambio
  <div class="container col-md-6 col-lg-6 col-6">
    <div class="steps">
        <span class="circle active">1</span>
        <span class="circle active">2</span>
        <span class="circle">3</span>
        <span class="circle">4</span>
        <div class="progress-bar">
          <span class="indicator"></span>
        </div>
      </div>
    </div>
 end step indicators -->

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
            <div class="card-header step-wizard">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Nuevo Tratamiento') }}</h1>
                   
                </div>
            </div>
           
    
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">


                            <div class="col-md-6 col-lg-6 col-6">
                                <label for="name">{{ __('Fecha del Ingreso:') }}  </label>
                                    <input type="date" class="form-control col-lg-6 col-6" id="fecha" name="fecha" value="{{ $hoy=date('Y-m-d') }}" />
                               
                              </div>
                         @if(auth()->user()->rol=="ADMINISTRADOR")

                          <div class="form-group col-md-6 col-lg-6 col-6">
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
                          @endif
                          
                        </div>
                    </div>

                    
        
           
                    <div class="my-class-form-control-group col-md-8 col-lg-8 col-8">
                        <label for="name">{{ __('Seleccione Paciente') }}</label>
                        <select class="form-select " id="customer_id" name="customer_id" required>
                            <option value="">Seleccione Paciente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }} - {{ $customer->id }}</option>
                            @endforeach
                           
                        </select>
                        
                        <a style="width: 50%; " href="{{ route('customers.create') }}" class="btn btn-success">
                            <i class="nav-icon fa fa-user-plus"></i>
                            <p>Agregar Paciente</p>
                        </a>
                    
                    </div>


                  
                    <div class="form-group col-md-4 col-lg-4 col-4">
                        <label for="last_name">Maxilares</label>
                        <select name="periodo" class="form-select" id="periodo">
                            <option value="Superior">Superior</option>
                            <option value="Inferior">Inferior</option>
                            <option value=" Ambos maxilares"> Ambos maxilares</option>
                          
                        </select>
                    </div>
    
                    <div class="form-group col-md-10 col-lg-10 col-10">
    
                        <button  id="Short"  type="button" class="btn btn-outline-primary" value="Short" onclick="cargar(this.value)">Short</button>
                        <button  id="Medium"   type="button" class="btn btn-outline-secondary" value="Medium" onclick="cargar(this.value)">Medium</button>
                        <button  id="Kids"  type="button" class="btn btn-outline-danger" value="Kids" onclick="cargar(this.value)">Kids</button>
                        <button  id="EasyO" type="button" class="btn btn-outline-warning" value="Easy O" onclick="cargar(this.value)">Easy O</button>
                        <button  id="EasyR"  type="button" class="btn btn-outline-info" value="Easy R" onclick="cargar(this.value)">Easy R</button>
                        <input type="hidden" class="form-control col-lg-6 col-6" id="descripcion" name="descripcion"  />


                    </div>
                    <div class="alert alert-info mb-0 text-green-800 justify-content" role="alert">Solo puede seleccionar un solo Tratamiento del Listado </div>

                    
                    <button type="submit" class="btn btn-primary btn-block col-md-4 col-lg-4 col-4">{{ __('Registrar Nuevo Tratamiento') }}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   
<script>
    function cargar (valor) {
     var fired_button =  valor;
     $("#descripcion").val(fired_button);
    // alert(fired_button);
   
//$("#".fired_button).style.backgroundColor="blue";
   // document.getElementsByName(fired_button).style.backgroundColor = "#0000FF"; 
   // var miElemento = document.getElementsByName(fired_button);
   /*if(valor=='Short')
    $( "#Short" ).css('background', 'blue');
    if(valor=='Medium')
    $( "#Medium" ).css('background', 'gray');
    if(valor=='Kids')
    $( "#Kids" ).css('background', 'red');
    if(valor=='Easy O')
    $( "#EasyO" ).css('background', 'orange');
    if(valor=='Easy R')
    $( "#EasyR" ).css('background', '#0dcaf0');
    */
 }
 </script>

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    
@endsection