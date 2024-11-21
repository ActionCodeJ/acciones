@extends('layouts.admin')

@section('title', 'Datos del Tratamiento')

@section('content-header', ' Tratamiento')

@section('content-actions')
    <input class="btn btn-primary  col-lg-3 col-3" type="button" onclick="printDiv('areaImprimir')" value="Imprimir" /> <i
        class="btn-danger fa-file-pdf-o "></i>

    <i class='fas fa-file-pdf' style='font-size:48px;color:red'></i>

    <a href="{{ route('orders.index') }}" class="btn btn-success"><i class="fas fa-eye"> Listado de Tratamiento</i></a>


@endsection




@section('content')

    <script language="Javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var document_html = window.open('_blank');
            document_html.document.write(
                '<link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css\" type=\"text/css\"/>'
                );


            document_html.document.write('<link rel=\"stylesheet\" href=\"../css/app.css\" type=\"text/css\"/>');


            document_html.document.write(
                '<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css\" type=\"text/css\"/>'
                );
            document_html.document.write(
                '<link rel=\"stylesheet\" href=\"https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css\" type=\"text/css\"/>'
                );

            document_html.document.write(printContents);

            setTimeout(function() {
                document_html.print();
            }, 500)
        }
    </script>
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

            <div class="card-body">

                <!-- id="seleccion"  para imprimir
                     -->

                <div id="areaImprimir">

                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">{{ __('Datos del Tratamiento') }}</h1>

                        </div>

                    </div>

                    <div class="form-group col-lg-3 col-3">
                        <label for="name">{{ __('Fecha') }}</label>
                        <input type="date" class="form-control" id="fecha" name="fecha"
                            value="{{ old('fecha', $order->fecha) }}" />
                    </div>

                    <div class="form-group">

                        <div class="p-3 mb-2 bg-light text-black font-weight-bold">
                            Maxilares: {{ $order->periodo }}
                             - Tipo: {{ $order->codigo }}
                             - Descripcion {{ $order->descripcion }}</div>
                    </div>
                    <div class="form-group">

                        <div class="p-3 mb-2 bg-light text-black font-weight-bold">Profesional: {{ $order->getUserName()}}
                             - Paciente: {{ $order->getCustomerName()}}
                             - Estado: {{ $order->estado }}</div>
                    </div>
                    <div class="form-group">

                        <div class="p-3 mb-2 bg-light text-black font-weight-bold">Link render: 
                            <a href="{{ $order->enlace}}"> Clic aqui para acceder al render </a>
                            
                            
                    </div>

                    <div class="form-group col-lg-12 col-8">
                        <a href="{{ route('orders.odontograma', $order) }}" class="btn btn-info">
                            Odontograma <i class="fas fa-tooth" style="font-size:24px;color:white"></i>

                        </a>
                        <a href="{{ route('orders.secciones', $order) }}" class="btn btn-primary">Carga de documentos <i
                                class="	fa fa-file" style="font-size:24px;color:white"></i></a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Carga de Imagenes <i
                                class="fas fa-image" style="font-size:24px;color:blue"></i></a>


                        <a href="{{ route('orders.descripcion', $order) }}" class="btn btn-danger">Descripcion <i
                                class="fas fa-braille" style="font-size:24px;color:white"></i></a>
                    </div>

                    @if (!empty($order->avatar))
                        <table>
                            <tr>
                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getAvatarUrl() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getAvatarUrl() }}" target="_blank"
                                            rel=" Comprobante">Imagen 1</a>.</p>

                                </td>

                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen2Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen2Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 2</a>.</p>
                                </td>
                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen3Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen3Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 3</a>.</p>

                                </td>



                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen4Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen4Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 5</a>.</p>

                                </td>

                            </tr>



                            <tr>


                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen5Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen5Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 6</a>.</p>

                                </td>
                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen6Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen6Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 7</a>.</p>

                                </td>
                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen7Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen7Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 8</a>.</p>

                                </td>
                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen8Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen8Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 9</a>.</p>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img width="200px" class="img-thumbnail" src="{{ $order->getImagen9Url() }}"
                                        alt="">
                                    <p>Ver Imagen <a href="{{ $order->getImagen9Url() }}" target="_blank"
                                            rel=" Comprobante">Imagen 9</a>.</p>

                                </td>
                            </tr>
                        </table>
                    @endif




                    <div class="form-group col-lg-12 col-8">


                    </div>







                </div>
                <!-- fin impresion -->


                <?php ?>
                <div class="form-group col-lg-12 col-8 d-none">
                    <a href="{{ route('orders.odontograma', $order) }}" class="btn btn-info">
                        Odontograma <i class="fas fa-tooth" style="font-size:24px;color:white"></i>

                    </a>
                    <a href="{{ route('orders.secciones', $order) }}" class="btn btn-primary">Carga de documentos <i
                            class="	fa fa-file" style="font-size:24px;color:white"></i></a>
                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Carga de Imagenes <i
                            class="fas fa-image" style="font-size:24px;color:blue"></i></a>


                    <a href="{{ route('orders.descripcion', $order) }}" class="btn btn-danger">Descripcion <i
                            class="fas fa-braille" style="font-size:24px;color:white"></i></a>
                </div>
            </div>



            <!-- Content Row -->

        </div>
    @endsection
