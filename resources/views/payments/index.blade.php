@extends('layouts.admin')

@section('title', 'Documentos requeridos')
@section('content-header', 'Documentos Requeridos - Descargas')
@section('content-actions')
<!--<a href="{{route('payments.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> agregar nuevo Concepto</a>-->
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="contaanier-fluid" id="main-container">
    <div class="row bg-light p-3">

    </div>
   
    <div class="d-flex justify-content-center m-2">
        <a href="https://sistema.magicaligner.online/documents/QueEstudiosPedirCLASE 2.pdf" download="QueEstudiosPedirCLASE 2.pdf">
            <button type="button" class="btn btn-primary">Descargar Que Estudios Pedir CLASE 2</button>
        </a>
    </div> <br/>

    <div class="d-flex justify-content-center m-2">
        <a href="https://sistema.magicaligner.online/documents/FORMULARIO_INICIO.pdf" download="FORMULARIO_INICIO.pdf">
            <button type="button" class="btn btn-primary">Descargar FORMULARIO DE INICIO</button>
        </a>
    </div> <br/>
    <div class="d-flex justify-content-center m-2">
        <a href="https://sistema.magicaligner.online/documents/FormularioDiagnosticoTratamientoFase1.pdf" download="Formulario de Diagnostico de ratamientode Fase 1.pdf">
            <button type="button" class="btn btn-primary">Formulario de Diagnostico de ratamientode Fase 1</button>
        </a>
    </div> <br/>

    <div class="d-flex justify-content-center m-2">
        <a href="documents/ACUERDO_DE_TRATAMIENTO_FASE1.pdf" download="ACUERDO DE TRATAMIENTO FASE 1.pdf">
            <button type="button" class="btn btn-primary">Descargar ACUERDO DE TRATAMIENTO FASE 1</button>
        </a>
    </div> <br/>
    <div class="d-flex justify-content-center m-2">
        <a href="https://sistema.magicaligner.online/documents/ACUERDO_DE_TRATAMIENTO_FASE3.pdf" download="ACUERDO DE TRATAMIENTO FASE 3.pdf">
            <button type="button" class="btn btn-primary">Descargar ACUERDO DE TRATAMIENTO FASE 3</button>
        </a>
    </div> <br/>

    <div class="d-flex justify-content-center m-2">
        <a href="https://sistema.magicaligner.online/documents/ACUERDO_DE_TRATAMIENTO_SHORT.pdf" download="ACUERDO DE TRATAMIENTO SHORT.pdf">
            <button type="button" class="btn btn-primary">Descargar ACUERDO DE TRATAMIENTO SHORT</button>
        </a>
    </div> <br/>

    <div class="d-flex justify-content-center m-2">
        <a href="https://sistema.magicaligner.online/documents/FORMULARIO_FASE_II.pdf" download="FORMULARIO_FASE_II.pdf">
            <button type="button" class="btn btn-primary">Descargar FORMULARIO FASE II</button>
        </a>
    </div> <br/>

</div>

<div class="card Payment-list d-none" >
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr><!-- Log on to marco farfan 3888-15568587 for more projects -->
                    <th>Nro</th>
                  
                    <th>Monto</th>
                    
                   
                    <th>Fecha</th>
                    <th>Credito Nro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Payments as $Payment)
                <tr>
                    <td>{{$Payment->id}}</td>
                    
                    <td>{{config('settings.currency_symbol')}}{{$Payment->amount}}</td>
                     
                    <td>
                        {{date('d-m-Y', strtotime($Payment->date )) }}
                     
                    </td>
                    <td>
                    <a href="{{ route('orders.show', $Payment->order_id) }}" class="btn btn-primary">{{$Payment->getCustomerName()}} - Ver Prestamo {{$Payment->order_id}} - <i
                        class="fas fa-chart-line"></i></a>
                    </td>
                        <td>
                        <a href="{{ route('payments.edit', $Payment) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('payments.destroy', $Payment)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $Payments->render() }}
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-delete', function () {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Estas Seguro?',
                text: "Realmente quieres eliminar este Pago?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Borrar ahora!',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                        $this.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection
