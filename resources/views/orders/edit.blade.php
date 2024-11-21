@extends('layouts.admin')

@section('title', 'Nuevo Tratamiento')





@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* style.css */

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
            z-index: -0;
            /* ver linea  -1 ocultra*/
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

        .step-wizard-list {
            background: #fff;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            color: #333;
            list-style-type: none;
            border-radius: 10px;
            display: flex;
            padding: 20px 10px;
            position: relative;
            z-index: 10;
        }

        .step-wizard-item {
            padding: 0 20px;
            flex-basis: 0;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
            min-width: 170px;
            position: relative;
        }

        .step-wizard-item+.step-wizard-item:after {
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

        .progress-count {
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            margin: 0 auto;
            position: relative;
            z-index: 10;
            color: transparent;
        }

        .progress-count:after {
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

        .progress-count:before {
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

        .progress-label {
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
        }

        .current-item .progress-count:before,
        .current-item~.step-wizard-item .progress-count:before {
            display: none;
        }

        .current-item~.step-wizard-item .progress-count:after {
            height: 10px;
            width: 10px;
        }

        .current-item~.step-wizard-item .progress-label {
            opacity: 0.5;
        }

        .current-item .progress-count:after {
            background: #fff;
            border: 2px solid #21d4fd;
        }

        .current-item .progress-count {
            color: #21d4fd;
        }

        /**************************/
        /* Faked label styles and icon */


        input[type=file]::file-selector-button {
            margin-right: 1px;
            border: none;
            background: #084cdf;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 10pt;
            /*  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230964B0'%3E%3Cpath d='M18 15v3H6v-3H4v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-3h-2zM7 9l1.41 1.41L11 7.83V16h2V7.83l2.59 2.58L17 9l-5-5-5 5z'/%3E%3C/svg%3E");
        */
            content: 'Select some files';
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
        }
    </style>
    <!-- start step indicators -->

    <section class="step-wizard">
        <ul class="step-wizard-list">
            <li class="step-wizard-item">
                <span class="progress-count">1</span>
                <span class="progress-label">Datos Personales</span>
            </li>
            <li class="step-wizard-item ">
                <span class="progress-count">2</span>
                <span class="progress-label">Tratamiento</span>
            </li>
            <li class="step-wizard-item current-item">
                <span class="progress-count">3</span>
                <span class="progress-label">Imagenes</span>
            </li>
            <li class="step-wizard-item">
                <span class="progress-count">4</span>
                <span class="progress-label">Documentacion</span>
            </li>
        </ul>
    </section>


    <div class="container-fluid">

        <!-- Page Heading -->


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Content Row -->
        <div class="card shadow">
            <div class="card-header step-wizard">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Tratamiento - Carga de Imagenes') }} - <i class="fas fa-image"
                            style="font-size:88px;color:white"></i></h1>

                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.agregarCuentas', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="container">

                        <div class="alert alert-success" role="alert">Paciente: {{ $order->getCustomerName() }} - Maxilar:
                            {{ $order->periodo }} - Tratamiento: {{ $order->codigo }}...</div>

                        <div class="row align-items-start">


                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Frontal Reposo</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->avatar))
                                        <img id="output" src="{{ asset('images/frente.png') }}" width="100"
                                            height="100">
                                    @else
                                        <img id="output" src="{{ $order->getAvatarUrl() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif

                                    <input {{ $required }} id="avatar" name="avatar" type="file"
                                        accept="image/jpeg,image/heif,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Perfil izq. Reposo -opcional-</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->imagen2))
                                        <img id="output2" src="{{ asset('images/perfil2.png') }}" width="100"
                                            height="100">
                                    @else
                                        <img id="output2" src="{{ $order->getImagen2Url() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif
                                    <input id="imagen2" name="imagen2" type="file"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>

                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Perfil derecho Reposo</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->imagen3))
                                        <img id="output3" src="{{ asset('images/Perfil1.png') }}" width="100"
                                            height="100">
                                    @else
                                        <img id="output3" src="{{ $order->getImagen3Url() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif

                                    <input {{ $required }} id="imagen3" name="imagen3" type="file"
                                        accept="image/jpeg,image/heif,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output3').src = window.URL.createObjectURL(this.files[0])">

                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Sonrisa</div>
                                <div class="card-body text-primary">

                                    @if (empty($order->imagen9))
                                        <img id="output9" src="{{ asset('images/FrenteSonrisa.png') }}" width="100"
                                            height="100">
                                    @else
                                        <img id="output9" src="{{ $order->getImagen9Url() }}" width="100"
                                            height="100">
                                    @endif

                                    <input id="imagen9" name="imagen9" type="file"
                                        accept="image/jpeg,image/heif,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output9').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>


                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Oclusal Superior</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->imagen4))
                                        <img id="output4" src="{{ asset('images/olcusalSuperior.png') }}"
                                            width="100" height="100">
                                    @else
                                        <img id="output4" src="{{ $order->getImagen4Url() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif


                                    <input {{ $required }} id="imagen4" name="imagen4" type="file"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output4').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Oclusal Inferior</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->imagen5))
                                        <img id="output5" src="{{ asset('images/olcusalInferior.png') }}"
                                            width="100" height="100">
                                    @else
                                        <img id="output5" src="{{ $order->getImagen5Url() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif

                                    <input {{ $required }} id="imagen5" name="imagen5" type="file"
                                        accept="image/jpeg,image/heif,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output5').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Oclusión derecha</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->imagen6))
                                        <img id="output6" src="{{ asset('images/oclusionDerecha.png') }}"
                                            width="100" height="100">
                                    @else
                                        <img id="output6" src="{{ $order->getImagen6Url() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif


                                    <input {{ $required }} id="imagen6" name="imagen6" type="file"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output6').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Oclusión izquierda</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->imagen7))
                                        <img id="output7" src="{{ asset('images/oclusionIzquierda.png') }}"
                                            width="100" height="100">
                                    @else
                                        <img id="output7" src="{{ $order->getImagen7Url() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif


                                    <input {{ $required }} id="imagen7" name="imagen7" type="file"
                                        accept="image/jpeg,image/heif,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output7').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Oclusión Frente</div>
                                <div class="card-body text-primary">
                                    @php($required = 'required')
                                    @if (empty($order->imagen8))
                                        <img id="output8" src="{{ asset('images/bocaFrente.png') }}" width="100"
                                            height="100">
                                    @else
                                        <img id="output8" src="{{ $order->getImagen8Url() }}" width="100"
                                            height="100">
                                        @php($required = '')
                                    @endif


                                    <input {{ $required }} id="imagen8" name="imagen8" type="file"
                                        accept="image/jpeg,image/heif,image/gif,image/png,application/pdf,image/x-eps"
                                        onchange="document.getElementById('output8').src = window.URL.createObjectURL(this.files[0])">


                                </div>
                            </div>

                            <div class="form-group col-md-10 col-lg-10 col-10">

                                <input type="hidden" value="{{ $order->customer_id }}" id="customer_id"
                                    name="customer_id" />
                                <input type="hidden" value="{{ $order->estado }}" id="estado" name="estado" />


                                <input type="hidden" value="{{ $order->descripcion }}" id="descripcion"
                                    name="descripcion" />

                                <input type="hidden" value="{{ $order->periodo }}" id="periodo" name="periodo" />


                            </div>



                            <button type="submit"
                                class="btn btn-success btn-block col-md-4 col-lg-4 col-4">{{ __('Registrar Imagenes - Paso 2') }}
                                <i class="fas fa-image" style="font-size:32px;color:white"></i></a></button>

                            <a href="{{ route('orders.secciones', $order) }}"
                                class="btn btn-secondary btn-block col-md-2 col-lg-2 col-2"> Siguiente - <i
                                    class="	fa fa-arrow-circle-right" style="font-size:32px;color:white"></i></a>
                            <br>
                            <br><br><br>

                            @if (auth()->user()->rol == 'ADMINISTRADOR')
                                <div class="form-group col-lg-12 col-8">
                                    <a href="{{ route('orders.odontograma', $order) }}" class="btn btn-info">
                                        Odontograma <i class="fas fa-tooth" style="font-size:24px;color:white"></i>

                                    </a>
                                    <a href="{{ route('orders.secciones', $order) }}" class="btn btn-primary">Carga de
                                        documentos <i class="	fa fa-file" style="font-size:24px;color:white"></i></a>
                                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Carga de
                                        Imagenes <i class="fas fa-image" style="font-size:24px;color:blue"></i></a>


                                    <a href="{{ route('orders.descripcion', $order) }}"
                                        class="btn btn-danger">Descripcion <i class="fas fa-braille"
                                            style="font-size:24px;color:white"></i></a>
                                </div>
                            @endif
                </form>


            </div>
        </div>
    </div>


    <!-- Content Row -->

    </div>
@endsection


@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

@endsection
