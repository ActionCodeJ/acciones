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
            <li class="step-wizard-item ">
                <span class="progress-count">3</span>
                <span class="progress-label">Imagenes</span>
            </li>
            <li class="step-wizard-item ">
                <span class="progress-count">4</span>
                <span class="progress-label">Documentacion</span>
            </li>
            <li class="step-wizard-item current-item">
                <span class="progress-count">5</span>
                <span class="progress-label">Descripcion</span>
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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Nuevo Tratamiento - Descripcion') }}</h1>

                </div>
            </div>



            <div class="card-body">
                <form action="{{ route('orders.agregarDescripcion', $order) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="container">


                        <div class="alert alert-success" role="alert">{{ $order->getCustomerName() }} -
                            Maxilar:{{ $order->periodo }} - Tratamiento: {{ $order->codigo }}...</div>

                        <div class="row align-items-start">


                            <div class="card border-primary col-lg-16 col-16">
                                <div class="card-header text-white bg-primary mb-3"></div>
                                <div class="card-body text-primary">


                                    <textarea required id="descripcion" name="descripcion" rows="5" cols="83">{{ $order->descripcion }}</textarea>

                                </div>
                            </div>


                            <div class="form-group col-md-10 col-lg-10 col-10">

                                <input type="hidden" value="{{ $order->customer_id }}" id="customer_id" name="customer_id" />
                                <input type="hidden" value="{{ $order->estado }}"      id="estado" name="estado" />
                                <!--<input type="hidden" value="{{ $order->descripcion }}" id="descripcion" name="descripcion" />-->
                                <input type="hidden" value="{{ $order->periodo }}"     id="periodo" name="periodo" />


                            </div>


                            <button type="submit" style="background-color: #21fdcd;"
                                class="btn btn-info btn-block col-md-4 col-lg-4 col-4">
                                <i class="fa fa-flag-checkered" aria-hidden="true" style="font-size:24px;"></i>
                                {{ __('Registrar y Finalizar') }} <i class="fas fa-braille"
                                    style="font-size:24px;"></i></a></button>

                </form>
                <br>
                <br><br><br>
                @if (auth()->user()->rol != 'ADMINISTRADOR')
                    <div class="form-group col-lg-12 col-8">
                        <a href="{{ route('orders.odontograma', $order) }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-circle-left" style="font-size:24px;color:white"></i>
                            - Atras
                        </a>

                        <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">
                            Terminar - Ver <i class="fa fa-arrow-circle-right" style="font-size:24px;color:white"></i>

                        </a>

                    </div>
                @endif
                @if (auth()->user()->rol == 'ADMINISTRADOR')
                    <div class="form-group col-lg-12 col-8">
                        <a href="{{ route('orders.odontograma', $order) }}" class="btn btn-info">
                            Odontograma <i class="fas fa-tooth" style="font-size:24px;color:white"></i>

                        </a>
                        <a href="{{ route('orders.secciones', $order) }}" class="btn btn-primary">Carga de documentos <i
                                class="	fa fa-file" style="font-size:24px;color:white"></i></a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Carga de Imagenes <i
                                class="fas fa-image" style="font-size:24px;color:blue"></i></a>




                    </div>
                @endif
            </div>
        </div>


        <!-- Content Row -->

    </div>
@endsection


@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

@endsection
