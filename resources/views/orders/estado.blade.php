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

        .input-group-addon {
            background-color: #FFF;
        }
    </style>
    <!-- start step indicators -->


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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Actualizar Estado del Tratamiento') }}</h1>

                </div>
            </div>



            <div class="card-body">
                <form action="{{ route('orders.actualizarEstado', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="container">

                        <div class="alert alert-success" role="alert">{{ $order->getCustomerName() }} -
                            Maxilar:{{ $order->periodo }} - Tratamiento: {{ $order->codigo }}...</div>

                        <div class="row align-items-start">

                            <div class="card border-primary col-lg-10 col-10">
                                <div class="card-header text-white bg-primary mb-3">Actualizar Estado de Pedido</div>

                                <div class="card-body text-primary">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                                    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                                        rel="stylesheet" />

                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.js"></script>
                                    <link
                                        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.css"
                                        rel="stylesheet" />
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-en_US.js"></script>

                                    <select name="estado" id="estado" class="selectpicker">
                                        <option style="background-color: rgb(240, 245, 217);"
                                            data-icon="glyphicon glyphicon-star-empty" value="PENDIENTE"
                                            {{ $order->estado === 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>

                                        <option style="background-color: rgb(194, 245, 225);"
                                            data-icon="glyphicon glyphicon-ok-sign" value="APROBADO"
                                            {{ $order->estado === 'APROBADO' ? 'selected' : '' }}>APROBADO</option>
                                        <option style="background-color: rgb(245, 173, 167);"
                                            data-icon="glyphicon glyphicon-remove" value="RECHAZADO"
                                            {{ $order->estado === 'RECHAZADO' ? 'selected' : '' }}>RECHAZADO</option>

                                        <option style="background-color: rgb(212, 247, 252);"
                                            data-icon="glyphicon glyphicon-log-in" value="SOLICITUD  RECIBIDA"
                                            {{ $order->estado === 'SOLICITUD  RECIBIDA' ? 'selected' : '' }}>SOLICITUD
                                            RECIBIDA</option>

                                        <option style="background-color: rgb(249, 219, 252);"
                                            data-icon="glyphicon glyphicon-cog" value="PLAN EN MODIFICACIÓN"
                                            {{ $order->estado === 'PLAN EN MODIFICACIÓN' ? 'selected' : '' }}>PLAN EN
                                            MODIFICACIÓN</option>
                                        <option style="background-color: rgb(253, 242, 227);"
                                            data-icon="glyphicon glyphicon-list-alt" value="TIPO DE PLAN"
                                            {{ $order->estado === 'TIPO DE PLAN' ? 'selected' : '' }}>TIPO DE PLAN</option>

                                        <option style="background-color: rgb(219, 252, 209);"
                                            data-icon="glyphicon glyphicon-usd" value="COTIZACIÓN ENVIADA"
                                            {{ $order->estado === 'COTIZACIÓN ENVIADA' ? 'selected' : '' }}>COTIZACIÓN
                                            ENVIADA</option>
                                        <option style="background-color: rgb(104, 204, 250);"
                                            data-icon="glyphicon glyphicon-thumbs-up" value="ACEPTACION"
                                            {{ $order->estado === 'ACEPTACION' ? 'selected' : '' }}>ACEPTACION</option>


                                        <option style="background-color: rgb(219, 252, 209);"
                                            data-icon="glyphicon glyphicon-pencil" value="DISEÑO EN TRATAMIENTO"
                                            {{ $order->estado === 'DISEÑO EN TRATAMIENTO' ? 'selected' : '' }}>DISEÑO EN
                                            TRATAMIENTO</option>
                                        <option style="background-color: rgb(250, 101, 188);"
                                            data-icon="glyphicon glyphicon-scissors" value="RENDER CARGADO"
                                            {{ $order->estado === 'RENDER CARGADO' ? 'selected' : '' }}> RENDER CARGADO
                                        </option>
                                        <option style="background-color: rgb(252, 199, 183);"
                                            data-icon="glyphicon glyphicon-queen" value="DISEÑO DE MODELO"
                                            {{ $order->estado === 'DISEÑO DE MODELO' ? 'selected' : '' }}> DISEÑO DE MODELO
                                        </option>



                                        <option style="background-color: rgb(227, 228, 230);"
                                            data-icon="glyphicon glyphicon-share-alt" value="ENVIADO"
                                            {{ $order->estado === 'ENVIADO' ? 'selected' : '' }}> ENVIADO</option>
                                        <option style="background-color: rgb(146, 248, 189);"
                                            data-icon="glyphicon glyphicon-flag" value="ENTREGADO"
                                            {{ $order->estado === 'ENTREGADO' ? 'selected' : '' }}> ENTREGADO</option>

                                    </select>



                                </div>
                                <div class="alert alert-info mb-0 text-green-800 justify-content" role="alert">Los datos a
                                    registrar depende de los estados </div>


                                <div class="form-group  col-md-4 col-lg-4 col-4">
                                    <label for="last_name">Alineadores Impresos Superiores</label>
                                    <select name="alineadores_impresos_sup" class="form-select"
                                        id="alineadores_impresos_sup">
                                        <option
                                            value="Template"{{ $order->alineadores_impresos_sup === 'Template' ? 'selected' : '' }}>
                                            Template</option>
                                        <option
                                            value="1"{{ $order->alineadores_impresos_sup === '1' ? 'selected' : '' }}>
                                            1</option>
                                        <option
                                            value="2"{{ $order->alineadores_impresos_sup === '2' ? 'selected' : '' }}>
                                            2</option>
                                        <option
                                            value="3"{{ $order->alineadores_impresos_sup === '3' ? 'selected' : '' }}>
                                            3</option>
                                        <option
                                            value="4"{{ $order->alineadores_impresos_sup === '4' ? 'selected' : '' }}>
                                            4</option>
                                        <option
                                            value="5"{{ $order->alineadores_impresos_sup === '5' ? 'selected' : '' }}>
                                            5</option>
                                        <option
                                            value="6"{{ $order->alineadores_impresos_sup === '6' ? 'selected' : '' }}>
                                            6</option>
                                        <option
                                            value="7"{{ $order->alineadores_impresos_sup === '7' ? 'selected' : '' }}>
                                            7</option>
                                        <option
                                            value="8"{{ $order->alineadores_impresos_sup === '8' ? 'selected' : '' }}>
                                            8</option>
                                        <option
                                            value="9"{{ $order->alineadores_impresos_sup === '9' ? 'selected' : '' }}>
                                            9</option>
                                        <option
                                            value="10"{{ $order->alineadores_impresos_sup === '10' ? 'selected' : '' }}>
                                            10</option>
                                        <option
                                            value="11"{{ $order->alineadores_impresos_sup === '11' ? 'selected' : '' }}>
                                            11</option>
                                        <option
                                            value="12"{{ $order->alineadores_impresos_sup === '12' ? 'selected' : '' }}>
                                            12</option>
                                        <option
                                            value="13"{{ $order->alineadores_impresos_sup === '13' ? 'selected' : '' }}>
                                            13</option>
                                        <option
                                            value="14"{{ $order->alineadores_impresos_sup === '14' ? 'selected' : '' }}>
                                            14</option>
                                        <option
                                            value="15"{{ $order->alineadores_impresos_sup === '15' ? 'selected' : '' }}>
                                            15</option>
                                        <option
                                            value="16"{{ $order->alineadores_impresos_sup === '16' ? 'selected' : '' }}>
                                            16</option>6
                                        <option
                                            value="17"{{ $order->alineadores_impresos_sup === '17' ? 'selected' : '' }}>
                                            17</option>
                                        <option
                                            value="18"{{ $order->alineadores_impresos_sup === '18' ? 'selected' : '' }}>
                                            18</option>
                                        <option
                                            value="19"{{ $order->alineadores_impresos_sup === '19' ? 'selected' : '' }}>
                                            19</option>
                                        <option
                                            value="Contención"{{ $order->alineadores_impresos_sup === 'Contención' ? 'selected' : '' }}>
                                            Contención</option>
                                    </select>
                                </div>

                                <div class="form-group  col-md-4 col-lg-4 col-4">
                                    <label for="last_name">Alineadores Impresos Inferiores</label>
                                    <select name="alineadores_impresos_inf" class="form-select"
                                        id="alineadores_impresos_inf">
                                        <option
                                            value="Template"{{ $order->alineadores_impresos_inf === 'Template' ? 'selected' : '' }}>
                                            Template</option>
                                        <option
                                            value="1"{{ $order->alineadores_impresos_inf === '1' ? 'selected' : '' }}>
                                            1</option>
                                        <option
                                            value="2"{{ $order->alineadores_impresos_inf === '2' ? 'selected' : '' }}>
                                            2</option>
                                        <option
                                            value="3"{{ $order->alineadores_impresos_inf === '3' ? 'selected' : '' }}>
                                            3</option>
                                        <option
                                            value="4"{{ $order->alineadores_impresos_inf === '4' ? 'selected' : '' }}>
                                            4</option>
                                        <option
                                            value="5"{{ $order->alineadores_impresos_inf === '5' ? 'selected' : '' }}>
                                            5</option>
                                        <option
                                            value="6"{{ $order->alineadores_impresos_inf === '6' ? 'selected' : '' }}>
                                            6</option>
                                        <option
                                            value="7"{{ $order->alineadores_impresos_inf === '7' ? 'selected' : '' }}>
                                            7</option>
                                        <option
                                            value="8"{{ $order->alineadores_impresos_inf === '8' ? 'selected' : '' }}>
                                            8</option>
                                        <option
                                            value="9"{{ $order->alineadores_impresos_inf === '9' ? 'selected' : '' }}>
                                            9</option>
                                        <option
                                            value="10"{{ $order->alineadores_impresos_inf === '10' ? 'selected' : '' }}>
                                            10</option>
                                        <option
                                            value="11"{{ $order->alineadores_impresos_inf === '11' ? 'selected' : '' }}>
                                            11</option>
                                        <option
                                            value="12"{{ $order->alineadores_impresos_inf === '12' ? 'selected' : '' }}>
                                            12</option>
                                        <option
                                            value="13"{{ $order->alineadores_impresos_inf === '13' ? 'selected' : '' }}>
                                            13</option>
                                        <option
                                            value="14"{{ $order->alineadores_impresos_inf === '14' ? 'selected' : '' }}>
                                            14</option>
                                        <option
                                            value="15"{{ $order->alineadores_impresos_inf === '15' ? 'selected' : '' }}>
                                            15</option>
                                        <option
                                            value="16"{{ $order->alineadores_impresos_inf === '16' ? 'selected' : '' }}>
                                            16</option>6
                                        <option
                                            value="17"{{ $order->alineadores_impresos_inf === '17' ? 'selected' : '' }}>
                                            17</option>
                                        <option
                                            value="18"{{ $order->alineadores_impresos_inf === '18' ? 'selected' : '' }}>
                                            18</option>
                                        <option
                                            value="19"{{ $order->alineadores_impresos_inf === '19' ? 'selected' : '' }}>
                                            19</option>
                                        <option
                                            value="Contención"{{ $order->alineadores_impresos_inf === 'Contención' ? 'selected' : '' }}>
                                            Contención</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-4 col-lg-4 col-4">
                                    <label for="last_name">Alineadores Estampados Superiores</label>
                                    <select name="alineadores_estampados_sup" class="form-select"
                                        id="alineadores_estampados_sup">
                                        <option
                                            value="Template"{{ $order->alineadores_estampados_sup === 'Template' ? 'selected' : '' }}>
                                            Template</option>
                                        <option
                                            value="1"{{ $order->alineadores_estampados_sup === '1' ? 'selected' : '' }}>
                                            1</option>
                                        <option
                                            value="2"{{ $order->alineadores_estampados_sup === '2' ? 'selected' : '' }}>
                                            2</option>
                                        <option
                                            value="3"{{ $order->alineadores_estampados_sup === '3' ? 'selected' : '' }}>
                                            3</option>
                                        <option
                                            value="4"{{ $order->alineadores_estampados_sup === '4' ? 'selected' : '' }}>
                                            4</option>
                                        <option
                                            value="5"{{ $order->alineadores_estampados_sup === '5' ? 'selected' : '' }}>
                                            5</option>
                                        <option
                                            value="6"{{ $order->alineadores_estampados_sup === '6' ? 'selected' : '' }}>
                                            6</option>
                                        <option
                                            value="7"{{ $order->alineadores_estampados_sup === '7' ? 'selected' : '' }}>
                                            7</option>
                                        <option
                                            value="8"{{ $order->alineadores_estampados_sup === '8' ? 'selected' : '' }}>
                                            8</option>
                                        <option
                                            value="9"{{ $order->alineadores_estampados_sup === '9' ? 'selected' : '' }}>
                                            9</option>
                                        <option
                                            value="10"{{ $order->alineadores_estampados_sup === '10' ? 'selected' : '' }}>
                                            10</option>
                                        <option
                                            value="11"{{ $order->alineadores_estampados_sup === '11' ? 'selected' : '' }}>
                                            11</option>
                                        <option
                                            value="12"{{ $order->alineadores_estampados_sup === '12' ? 'selected' : '' }}>
                                            12</option>
                                        <option
                                            value="13"{{ $order->alineadores_estampados_sup === '13' ? 'selected' : '' }}>
                                            13</option>
                                        <option
                                            value="14"{{ $order->alineadores_estampados_sup === '14' ? 'selected' : '' }}>
                                            14</option>
                                        <option
                                            value="15"{{ $order->alineadores_estampados_sup === '15' ? 'selected' : '' }}>
                                            15</option>
                                        <option
                                            value="16"{{ $order->alineadores_estampados_sup === '16' ? 'selected' : '' }}>
                                            16</option>6
                                        <option
                                            value="17"{{ $order->alineadores_estampados_sup === '17' ? 'selected' : '' }}>
                                            17</option>
                                        <option
                                            value="18"{{ $order->alineadores_estampados_sup === '18' ? 'selected' : '' }}>
                                            18</option>
                                        <option
                                            value="19"{{ $order->alineadores_estampados_sup === '19' ? 'selected' : '' }}>
                                            19</option>
                                        <option
                                            value="Contención"{{ $order->alineadores_estampados_sup === 'Contención' ? 'selected' : '' }}>
                                            Contención</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-4 col-lg-4 col-4">
                                    <label for="last_name">Alineadores Estampados Inferiores</label>
                                    <select name="alineadores_estampados_inf" class="form-select"
                                        id="alineadores_estampados_inf">
                                        <option
                                            value="Template"{{ $order->alineadores_estampados_inf === 'Template' ? 'selected' : '' }}>
                                            Template</option>
                                        <option
                                            value="1"{{ $order->alineadores_estampados_inf === '1' ? 'selected' : '' }}>
                                            1</option>
                                        <option
                                            value="2"{{ $order->alineadores_estampados_inf === '2' ? 'selected' : '' }}>
                                            2</option>
                                        <option
                                            value="3"{{ $order->alineadores_estampados_inf === '3' ? 'selected' : '' }}>
                                            3</option>
                                        <option
                                            value="4"{{ $order->alineadores_estampados_inf === '4' ? 'selected' : '' }}>
                                            4</option>
                                        <option
                                            value="5"{{ $order->alineadores_estampados_inf === '5' ? 'selected' : '' }}>
                                            5</option>
                                        <option
                                            value="6"{{ $order->alineadores_estampados_inf === '6' ? 'selected' : '' }}>
                                            6</option>
                                        <option
                                            value="7"{{ $order->alineadores_estampados_inf === '7' ? 'selected' : '' }}>
                                            7</option>
                                        <option
                                            value="8"{{ $order->alineadores_estampados_inf === '8' ? 'selected' : '' }}>
                                            8</option>
                                        <option
                                            value="9"{{ $order->alineadores_estampados_inf === '9' ? 'selected' : '' }}>
                                            9</option>
                                        <option
                                            value="10"{{ $order->alineadores_estampados_inf === '10' ? 'selected' : '' }}>
                                            10</option>
                                        <option
                                            value="11"{{ $order->alineadores_estampados_inf === '11' ? 'selected' : '' }}>
                                            11</option>
                                        <option
                                            value="12"{{ $order->alineadores_estampados_inf === '12' ? 'selected' : '' }}>
                                            12</option>
                                        <option
                                            value="13"{{ $order->alineadores_estampados_inf === '13' ? 'selected' : '' }}>
                                            13</option>
                                        <option
                                            value="14"{{ $order->alineadores_estampados_inf === '14' ? 'selected' : '' }}>
                                            14</option>
                                        <option
                                            value="15"{{ $order->alineadores_estampados_inf === '15' ? 'selected' : '' }}>
                                            15</option>
                                        <option
                                            value="16"{{ $order->alineadores_estampados_inf === '16' ? 'selected' : '' }}>
                                            16</option>6
                                        <option
                                            value="17"{{ $order->alineadores_estampados_inf === '17' ? 'selected' : '' }}>
                                            17</option>
                                        <option
                                            value="18"{{ $order->alineadores_estampados_inf === '18' ? 'selected' : '' }}>
                                            18</option>
                                        <option
                                            value="19"{{ $order->alineadores_estampados_inf === '19' ? 'selected' : '' }}>
                                            19</option>
                                        <option
                                            value="Contención"{{ $order->alineadores_estampados_inf === 'Contención' ? 'selected' : '' }}>
                                            Contención</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-4 col-lg-4 col-4">
                                    <label for="last_name">Alineadores Entregados</label>
                                    <select name="alineadores_entregados" class="form-select"
                                        id="alineadores_entregados">
                                        <option
                                            value="Template"{{ $order->alineadores_entregados === 'Template' ? 'selected' : '' }}>
                                            Template</option>
                                        <option
                                            value="1"{{ $order->alineadores_entregados === '1' ? 'selected' : '' }}>
                                            1</option>
                                        <option
                                            value="2"{{ $order->alineadores_entregados === '2' ? 'selected' : '' }}>
                                            2</option>
                                        <option
                                            value="3"{{ $order->alineadores_entregados === '3' ? 'selected' : '' }}>
                                            3</option>
                                        <option
                                            value="4"{{ $order->alineadores_entregados === '4' ? 'selected' : '' }}>
                                            4</option>
                                        <option
                                            value="5"{{ $order->alineadores_entregados === '5' ? 'selected' : '' }}>
                                            5</option>
                                        <option
                                            value="6"{{ $order->alineadores_entregados === '6' ? 'selected' : '' }}>
                                            6</option>
                                        <option
                                            value="7"{{ $order->alineadores_entregados === '7' ? 'selected' : '' }}>
                                            7</option>
                                        <option
                                            value="8"{{ $order->alineadores_entregados === '8' ? 'selected' : '' }}>
                                            8</option>
                                        <option
                                            value="9"{{ $order->alineadores_entregados === '9' ? 'selected' : '' }}>
                                            9</option>
                                        <option
                                            value="10"{{ $order->alineadores_entregados === '10' ? 'selected' : '' }}>
                                            10</option>
                                        <option
                                            value="11"{{ $order->alineadores_entregados === '11' ? 'selected' : '' }}>
                                            11</option>
                                        <option
                                            value="12"{{ $order->alineadores_entregados === '12' ? 'selected' : '' }}>
                                            12</option>
                                        <option
                                            value="13"{{ $order->alineadores_entregados === '13' ? 'selected' : '' }}>
                                            13</option>
                                        <option
                                            value="14"{{ $order->alineadores_entregados === '14' ? 'selected' : '' }}>
                                            14</option>
                                        <option
                                            value="15"{{ $order->alineadores_entregados === '15' ? 'selected' : '' }}>
                                            15</option>
                                        <option
                                            value="16"{{ $order->alineadores_entregados === '16' ? 'selected' : '' }}>
                                            16</option>6
                                        <option
                                            value="17"{{ $order->alineadores_entregados === '17' ? 'selected' : '' }}>
                                            17</option>
                                        <option
                                            value="18"{{ $order->alineadores_entregados === '18' ? 'selected' : '' }}>
                                            18</option>
                                        <option
                                            value="19"{{ $order->alineadores_entregados === '19' ? 'selected' : '' }}>
                                            19</option>
                                        <option
                                            value="Contención"{{ $order->alineadores_entregados === 'Contención' ? 'selected' : '' }}>
                                            Contención</option>

                                    </select>
                                </div>

                                <div class="form-group col-lg-6 col-6">
                                    <label for="last_name">Monto del tratamiento</label>
                                    <input type="text" name="monto"
                                        class="form-control @error('monto') is-invalid @enderror" id="monto"
                                        placeholder="monto" value="{{ $order->monto }}">
                                    @error('monto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-6">
                                    <label for="last_name">Total Pagado</label>
                                    <input type="text" name="pagado"
                                        class="form-control @error('pagado') is-invalid @enderror" id="pagado"
                                        placeholder="pagado" value="{{ $order->pagado }}">
                                    @error('pagado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-6">
                                    <label for="last_name">Responsable de Produccion</label>
                                    <input type="text" name="responsable_produccion"
                                        class="form-control @error('responsable') is-invalid @enderror"
                                        id="responsable_produccion	" placeholder="responsable"
                                        value="{{ $order->responsable_produccion }}">
                                    @error('responsable_produccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-6">
                                    <label for="last_name">Link render</label>
                                    <input type="url" name="enlace"
                                        class="form-control @error('enlace') is-invalid @enderror"
                                        id="enlace	" placeholder="enlace"
                                        value="{{ $order->enlace }}">
                                    @error('enlace')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group col-md-6 col-lg-6 col-6">

                                <input type="hidden" value="{{ $order->customer_id }}" id="customer_id"
                                    name="customer_id" />


                                <input type="hidden" value="{{ $order->descripcion }}" id="descripcion"
                                    name="descripcion" />

                                <input type="hidden" value="{{ $order->periodo }}" id="periodo" name="periodo" />



                                <button type="submit"
                                    class="btn btn-secondary btn-block col-md-6 col-lg-6 col-6">{{ __('Actualizar Estado') }}
                                    <i class="fas fa-info-circle" style="font-size:24px;color:white"></i></a></button>


                            </div>



                </form>
                <br>

            </div>
        </div>


        <!-- Content Row -->

    </div>
@endsection


@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

@endsection
