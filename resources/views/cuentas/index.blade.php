@extends('layouts.admin')

@section('title', 'Cuentas ')
@section('content-header', 'Cuentas ')

@section('content-actions')
<a href="{{route('users.index')}}" class="btn btn-danger"><i class="fas fa-plus"></i> Cuentas Asociadas</a>
    <a href="{{route('cuentas.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Registar nueva Cuenta</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <i class="nav-icon fa fa-university"></i>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID <i class="nav-icon fa fa-university"></i></th>
                 
                    <th>Banco</th>
                    <th>Numero</th>
                    <th>Alias</th>
                    <th>Cbu</th>
                    <th>Cuenta</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cuentas as $cuenta)
                <?php
                // print_r($cuenta);
            
            //echo $cuenta->id.$cuenta->numero.$cuenta->banco;
                         
                                   
                                    
                               
                            //  echo $tipo."mensaje:".$clase;
                             ?>

                    <tr class="" >
                        <td>{{$cuenta->id}}</td>
                        
                        <td>{{$cuenta->banco}}</td>
                        <td>{{$cuenta->numero}}</td>
                        <td>{{$cuenta->alias}}</td>
                        <td>{{$cuenta->cbu}}</td>
                        <td>
                        
                            {!! !empty($cuenta->dolar) ? '<label class="btn btn-success" >$$Cuenta En Dolares $$</label>' : '<label class="btn btn-primary" >Cuenta en Pesos</label>' !!}

                        </td>
                        <td>
                            <a href="{{ route('cuentas.edit', $cuenta) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('cuentas.destroy', $cuenta)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $cuentas->render() }}
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
                    title: 'Are you sure?',
                    text: "Do you really want to delete this cuenta?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
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
