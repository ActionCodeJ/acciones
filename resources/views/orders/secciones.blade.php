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
            <li class="step-wizard-item current-item">
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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Nuevo Tratamiento - Carga de Documentos') }} </h1>
                    - <i class="fa fa-file" style="font-size:88px;color:white"></i>
                </div>
            </div>



            <div class="card-body">
                <form action="{{ route('orders.agregarDocumentos', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="container">


                        <div class="alert alert-success" role="alert">Paciente: {{ $order->getCustomerName() }} - Maxilar:
                            {{ $order->periodo }} - Tratamiento: {{ $order->codigo }}...</div>

                        <div class="row align-items-start">

                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Ortopantomografía</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension = substr($order->documento, -3);
                                        $required = 'required';
                                    @endphp
                                    @if (empty($order->documento))
                                        <img id="output" src="{{ asset('images/ortopantomografia.png') }}" width="100"
                                            height="100">
                                    @elseif($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg')
                                        <img id="output" src="{{ $order->getDocumentoUrl() }}" width="100"
                                            height="100">
                                        {{ $required = '' }}
                                    @else
                                        {{ $required = '' }}
                                        <a target="_blank" href="{{ $order->getDocumentoUrl() }}"
                                            class="btn btn-secondary">Ver Ortopantomografía <i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif
                                    <input {{ $required }} id="documento" name="documento" type="file"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile(event)">


                                </div>

                                <script>
                                    var loadFile = function(event) {
                                        var output = document.getElementById('output');
                                        var files = event.target.files
                                        var filename = event.target.files[0].name;
                                        var extension = event.target.files[0].type;
                                        var files = event.target.files[0]
                                        // for getting only extension 
                                        var fileExtension = files.type.split("/").pop();
                                        var fileName = files.name
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                        // alert(fileExtension);
                                        if (fileExtension == 'pdf') {
                                            //  alert(fileExtension);
                                            output.src = '/images/pdf2.jpg';
                                        }
                                        if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg') {
                                            output.src = '/images/archivo.png';
                                        }

                                        // alert(output.src);
                                        output.onload = function() {
                                            URL.revokeObjectURL(output.src) // free memory
                                        }
                                    };
                                </script>
                            </div>


                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Telerradiografía de Perfil</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension2 = substr($order->documento2, -3);
                                        $required = 'required';
                                    @endphp

                                    @if (empty($order->documento2))
                                        <img id="output2" src="{{ asset('images/TeleRxPerfil.png') }}" width="100"
                                            height="100">
                                    @elseif($extension2 == 'jpg' || $extension2 == 'png' || $extension2 == 'jpeg')
                                        <img id="output2" src="{{ $order->getDocumento2Url() }}" width="100"
                                            height="100">
                                        {{ $required = '' }}
                                    @else
                                        {{ $required = '' }}
                                        <a target="_blank" href="{{ $order->getDocumento2Url() }}"
                                            class="btn btn-secondary">Ver Teleradiografia <i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif

                                    <input {{ $required }} id="documento2" name="documento2" type="file"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile2(event)">

                                    <script>
                                        var loadFile2 = function(event) {
                                            var output = document.getElementById('output2');
                                            var files = event.target.files
                                            var filename = event.target.files[0].name;
                                            var extension = event.target.files[0].type;
                                            var files = event.target.files[0]
                                            // for getting only extension 
                                            var fileExtension = files.type.split("/").pop();
                                            var fileName = files.name
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            // alert(fileExtension);
                                            if (fileExtension == 'pdf') {
                                                //  alert(fileExtension);
                                                output.src = '/images/pdf2.jpg';
                                            }
                                            if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg') {
                                                output.src = '/images/archivo.png';
                                            }

                                            // alert(output.src);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>

                                </div>
                            </div>

                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Telerradiografía de Frente</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension3 = substr($order->documento3, -3);
                                        $required = 'required';
                                    @endphp

                                    @if (empty($order->documento3))
                                        <img id="output3" src="{{ asset('images/TeleRxFrente.png') }}" width="100"
                                            height="100">
                                    @elseif($extension3 == 'jpg' || $extension3 == 'png' || $extension3 == 'jpeg')
                                        <img id="output3" src="{{ $order->getDocumento3Url() }}" width="100"
                                            height="100">
                                        {{ $required = '' }}
                                    @else
                                        {{ $required = '' }}
                                        <a target="_blank" href="{{ $order->getDocumento3Url() }}"
                                            class="btn btn-secondary">Ver Telerradiografía de Frente <i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif

                                    <input {{ $required }} id="documento3" name="documento3" type="file"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile3(event)">

                                    <script>
                                        var loadFile3 = function(event) {
                                            var output = document.getElementById('output3');
                                            var files = event.target.files
                                            var filename = event.target.files[0].name;
                                            var extension = event.target.files[0].type;
                                            var files = event.target.files[0]
                                            // for getting only extension 
                                            var fileExtension = files.type.split("/").pop();
                                            var fileName = files.name
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            // alert(fileExtension);
                                            if (fileExtension == 'pdf') {
                                                //  alert(fileExtension);
                                                output.src = '/images/pdf2.jpg';
                                            }
                                            if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg') {
                                                output.src = '/images/archivo.png';
                                            }

                                            // alert(output.src);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                </div>
                            </div>


                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Ricketts</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension4 = substr($order->documento4, -3);

                                    @endphp
                                    @if (empty($order->documento4))
                                        <img id="output4" src="{{ asset('images/Ricketts.png') }}" width="100"
                                            height="100">
                                    @elseif($extension4 == 'jpg' || $extension4 == 'png' || $extension4 == 'jpeg')
                                        <img id="output4" src="{{ $order->getDocumento4Url() }}" width="100"
                                            height="100">
                                    @elseif($extension4 == 'pdf' || $extension4 == 'docx' || $extension4 == 'doc')
                                        <img id="output4" src="{{ asset('images/Ricketts.png') }}" width="100"
                                            height="100">
                                    @else
                                        <a target="_blank" href="{{ $order->getDocumento4Url() }}"
                                            class="btn btn-secondary">Ver Ricketts <i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif




                                    <input id="documento4" name="documento4" type="file"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile4(event)">

                                    <script>
                                        var loadFile4 = function(event) {
                                            var output = document.getElementById('output4');
                                            var files = event.target.files
                                            var filename = event.target.files[0].name;
                                            var extension = event.target.files[0].type;
                                            var files = event.target.files[0]
                                            // for getting only extension 
                                            var fileExtension = files.type.split("/").pop();
                                            var fileName = files.name
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            // alert(fileExtension);
                                            if (fileExtension == 'pdf') {
                                                //  alert(fileExtension);
                                                output.src = '/images/pdf2.jpg';
                                            }
                                            if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg') {
                                                output.src = '/images/archivo.png';
                                            }

                                            // alert(output.src);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Documento de Fase</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension5 = substr($order->documento_Fase, -3);

                                    @endphp
                                    @if (empty($order->documento_Fase))
                                        <img id="output5" src="{{ asset('images/documentoFase.png') }}" width="100"
                                            height="100">
                                    @elseif($extension5 == 'jpg' || $extension5 == 'png' || $extension5 == 'jpeg')
                                        <img id="output5" src="{{ $order->getDocumentoFaseUrl() }}" width="100"
                                            height="100">
                                    @elseif($extension5 == 'pdf' || $extension5 == 'docx' || $extension5 == 'doc')
                                        <img id="output5" src="{{ asset('images/prestamo.png') }}" width="100"
                                            height="100">
                                    @else
                                        <a target="_blank" href="{{ $order->getDocumentoFaseUrl() }}"
                                            class="btn btn-secondary">Ver Documento Fase <i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif
                                    <input id="docuemnto_Fase" name="docuemnto_Fase" type="file"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile5(event)">

                                    <script>
                                        var loadFile5 = function(event) {
                                            var output = document.getElementById('output5');
                                            var files = event.target.files
                                            var filename = event.target.files[0].name;
                                            var extension = event.target.files[0].type;
                                            var files = event.target.files[0]
                                            // for getting only extension 
                                            var fileExtension = files.type.split("/").pop();
                                            var fileName = files.name
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            // alert(fileExtension);
                                            if (fileExtension == 'pdf') {
                                                //  alert(fileExtension);
                                                output.src = '/images/pdf2.jpg';
                                            }
                                            if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg') {
                                                output.src = '/images/archivo.png';
                                            }

                                            // alert(output.src);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                </div>
                            </div>

                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">B Jarabak</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension6 = substr($order->b_jarabak, -3);

                                    @endphp
                                    @if (empty($order->b_jarabak))
                                        <img id="output6" src="{{ asset('images/b_jarabak.png') }}" width="100"
                                            height="100">
                                    @elseif($extension6 == 'jpg' || $extension6 == 'png' || $extension6 == 'jpeg')
                                        <img id="output6" src="{{ $order->getBJarabakUrl() }}" width="100"
                                            height="100">
                                    @elseif($extension6 == 'pdf' || $extension6 == 'docx' || $extension6 == 'doc')
                                        <img id="output6" src="{{ asset('images/b_jarabak.png') }}" width="100"
                                            height="100">
                                    @else
                                        <a target="_blank" href="{{ $order->getBJarabakUrl() }}"
                                            class="btn btn-secondary">Ver B Jarabak<i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif

                                    <input id="b_jarabak" name="b_jarabak" type="file"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile6(event)">

                                    <script>
                                        var loadFile6 = function(event) {
                                            var output = document.getElementById('output6');
                                            var files = event.target.files
                                            var filename = event.target.files[0].name;
                                            var extension = event.target.files[0].type;
                                            var files = event.target.files[0]
                                            // for getting only extension 
                                            var fileExtension = files.type.split("/").pop();
                                            var fileName = files.name
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            // alert(fileExtension);
                                            if (fileExtension == 'pdf') {
                                                //  alert(fileExtension);
                                                output.src = '/images/pdf2.jpg';
                                            }
                                            if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg'&& fileExtension != 'stl') {
                                                output.src = '/images/archivo.png';
                                            }

                                            // alert(output.src);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Mc Namara</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension7 = substr($order->mc_namara, -3);

                                    @endphp
                                    @if (empty($order->mc_namara))
                                        <img id="output7" src="{{ asset('images/mc_namara.png') }}" width="100"
                                            height="100">
                                    @elseif($extension7 == 'jpg' || $extension7 == 'png' || $extension7 == 'jpeg')
                                        <img id="output7" src="{{ $order->getMcNamaraUrl() }}" width="100"
                                            height="100">
                                    @elseif($extension7 == 'pdf' || $extension7 == 'docx' || $extension7 == 'doc')
                                        <img id="output7" src="{{ asset('images/mc_namara.png') }}" width="100"
                                            height="100">
                                    @else
                                        <a target="_blank" href="{{ $order->getMcNamaraUrl() }}"
                                            class="btn btn-secondary">Ver B Jarabak<i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif

                                    <input id="mc_namara" name="mc_namara" type="file"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile7(event)">

                                    <script>
                                        var loadFile7 = function(event) {
                                            var output = document.getElementById('output7');
                                            var files = event.target.files
                                            var filename = event.target.files[0].name;
                                            var extension = event.target.files[0].type;
                                            var files = event.target.files[0]
                                            // for getting only extension 
                                            var fileExtension = files.type.split("/").pop();
                                            var fileName = files.name
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            // alert(fileExtension);
                                            if (fileExtension == 'pdf') {
                                                //  alert(fileExtension);
                                                output.src = '/images/pdf2.jpg';
                                            }
                                            if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg'&& fileExtension != 'stl') {
                                                output.src = '/images/archivo.png';
                                            }

                                            // alert(output.src);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                </div>
                            </div>
                            <div class="card border-primary col-lg-4 col-4">
                                <div class="card-header text-white bg-primary mb-3">Escaner STL</div>
                                <div class="card-body text-primary">
                                    @php
                                        $extension8 = substr($order->archivo_STL, -3);

                                    @endphp
                                    @if (empty($order->archivo_STL))
                                        <img id="output8" src="{{ asset('images/scanTsl.png') }}" width="100"
                                            height="100">
                                    @elseif($extension8 == 'jpg' || $extension8 == 'png' || $extension8 == 'jpeg')
                                        <img id="output8" src="{{ $order->getArchivoSTLUrl() }}" width="100"
                                            height="100">
                                    @elseif($extension8 == 'pdf' || $extension8 == 'docx' || $extension8 == 'doc'|| $extension8 == 'stl')
                                        <img id="output8" src="{{ asset('images/file.png') }}" width="100"
                                            height="100">
                                    @else
                                        <a target="_blank" href="{{ $order->getArchivoSTLUrl() }}"
                                            class="btn btn-secondary">Ver Documento Fase <i class="	fa fa-file"
                                                style="font-size:68px;color:white"></i></a>
                                    @endif

                                    <input id="archivo_STL" name="archivo_STL" type="file"
                                        accept="image/*,stl,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        onchange="loadFile8(event)">

                                    <script>
                                        var loadFile8 = function(event) {
                                            var output = document.getElementById('output8');
                                            var files = event.target.files
                                            var filename = event.target.files[0].name;
                                            var extension = event.target.files[0].type;
                                            var files = event.target.files[0]
                                            // for getting only extension 
                                            var fileExtension = files.type.split("/").pop();
                                            var fileName = files.name
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            // alert(fileExtension);
                                            if (fileExtension == 'pdf') {
                                                //  alert(fileExtension);
                                                output.src = '/images/pdf2.jpg';
                                            }
                                            if (fileExtension != 'pdf' && fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg'&& fileExtension != 'stl') {
                                                output.src = '/images/archivo.png';
                                            }

                                            // alert(output.src);
                                            output.onload = function() {
                                                URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
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
                                class="btn btn-success btn-block col-md-4 col-lg-4 col-4">{{ __('Registrar Paso 3 - Documentos') }}
                                -
                                <i class="fa fa-file" style="font-size:24px;color:white"></i></button>



                </form>
                <br>
                <br><br><br>
                @if (auth()->user()->rol != 'ADMINISTRADOR')
                    <div class="form-group col-lg-12 col-8">

                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-secondary"><i
                                class="fa fa-arrow-circle-left" style="font-size:24px;color:rgb(238, 238, 250)"></i> -
                            Atras </a>

                        <a href="{{ route('orders.odontograma', $order) }}" class="btn btn-secondary">
                            Siguiente - <i class="fa fa-arrow-circle-right" style="font-size:24px;color:white"></i>

                        </a>
                @endif


                @if (auth()->user()->rol == 'ADMINISTRADOR')
                    <div class="form-group col-lg-12 col-8">
                        <a href="{{ route('orders.odontograma', $order) }}" class="btn btn-info">
                            Odontograma <i class="fas fa-tooth" style="font-size:24px;color:white"></i>

                        </a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Carga de Imagenes <i
                                class="fas fa-image" style="font-size:24px;color:blue"></i></a>


                        <a href="{{ route('orders.descripcion', $order) }}" class="btn btn-danger">Descripcion <i
                                class="fas fa-braille" style="font-size:24px;color:white"></i></a>
                    </div>
                @endif

            </div>
        </div>
    </div>


    <!-- Content Row -->

    </div>
@endsection


@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

@endsection
