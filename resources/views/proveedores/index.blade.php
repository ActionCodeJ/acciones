@extends('layouts.admin')

@section('title', 'Proveedor ')
@section('content-header', 'proveedor ')
@section('content-actions')
    <a href="{{route('proveedores.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Registar nuevo proveedor</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                   
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Contacto</th>
                    <th>Direccion</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{$proveedor->id}}</td>
                        
                        <td>{{$proveedor->first_name}} {{$proveedor->last_name}}</td>
                        <td>{{$proveedor->email}}</td>
                        <td>{{$proveedor->phone}}</td>
                        <td>{{$proveedor->address}}</td>
                        <td>{{$proveedor->created_at}}</td>
                        <td>
                            <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('proveedores.destroy', $proveedor)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $proveedores->render() }}
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
                    text: "Do you really want to delete this proveedor?",
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
