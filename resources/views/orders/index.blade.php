@extends('layouts.admin')

@section('title', ' Listado de Tratamientos')
@section('content-header', ' Tratamientos')
@section('content-actions')

    <!--<a href="{{ route('cart.index') }}"  class="btn btn-secondary">+ NUEVO</a>-->
    <a type="button" class="btn btn-primary"  href="{{ route('cart.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
        </svg>
        Nuevo
    </a>
    <button type="button"  onclick="printDiv('areaImprimir')" class="btn btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"></path>
            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"></path>
        </svg>
        Imprimir
    </button>
    <!--<input class="btn btn-primary  col-lg-3 col-3" type="button" onclick="printDiv('areaImprimir')" value="Imprimir Listado"  />
        <i class="btn-danger fa-file-pdf-o "></i>
        <i class='fas fa-file-pdf' style='font-size:48px;color:red'></i>-->
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


    <!-- id="seleccion"  para imprimir
                     -->
    <div id="areaImprimir">

        <div class="alert alert-success h3 mb-0 text-green-800 justify-content" role="alert">Listado de Tratamientos</div>

        </h1>

    </div>
    <div class="card"><!-- Log on to marco farfan 3888-15568587 for more projects -->
        <div class="card-body">
            <div class="row">
                <!-- <div class="col-md-3"></div> -->
                <div class="col-md-12">
                    <form action="{{ route('orders.index') }}">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}" />
                            </div>
                            <div class="col-md-5">
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}" />
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
                        <th>Paciente</th>
                        <th>Maxilar</th>
                        <th>Tratamiento</th>
                        <th>Estado</th>
                        <th>Render</th>
                        <th>Creado</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->getCustomerName() }} - {{ $order->codigo }}</td>
                            <td>{{ $order->periodo }}</td>
                            <td>{{ $order->codigo }}</td>
                            <td>
                                @if ($order->estado == 'RECHAZADO')
                                    <span class="badge badge-danger">{{ $order->estado }}</span>
                                @elseif($order->estado == 'PENDIENTE')
                                    <span class="badge badge-warning">PENDIENTE</span>
                                @elseif($order->estado == 'APROBADO')
                                    <span class="badge badge-success">{{ $order->estado }}</span>
                                @elseif($order->estado == 'ENVIADO')
                                    <span class="badge badge-secundary">{{ $order->estado }}</span>
                                @elseif($order->estado == 'SOLICITUD  RECIBIDA')
                                    <span class="badge badge-info">{{ $order->estado }}</span>
                                @elseif($order->estado == 'COTIZACIÓN ENVIADA')
                                    <span class="badge badge-dark">{{ $order->estado }}</span>
                                @else
                                    <span class="badge badge-primary">{{ $order->estado }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->enlace)
                                    <a href="{{ $order->enlace}}"class="btn btn-success" title="Ir al render"> ir al render </a>
                                @endif
                            </td>
                            <td>
                                {{ date('d-m-Y', strtotime($order->created_at)) }}
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-success" title="Ver Datos"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary" title="Modificar"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('orders.estado', $order) }}" class="btn btn-secondary"
                                    title="Cambiar Estado"><i class='fas fa-info-circle'></i></a>


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
