@extends('layouts.admin')

@section('title', 'secciones ')
@section('content-header', 'secciones ')

@section('content-actions')

    <a href="{{route('secciones.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Registar nueva seccion</a>
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
                 
                    <th>Nombre</th>
                    <th>descripcion</th>
                    <th>Area</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($secciones as $seccion)
                    <tr>
                        <td>{{$seccion->id}}</td>
                        
                        <td>{{$seccion->nombre}}</td>
                        <td>{{$seccion->descripcion}}</td>
                        <td>{{$seccion->area->nombre}}</td>
                        
                        <td>
                            <a href="{{ route('secciones.edit', $seccion) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('secciones.destroy', $seccion)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $secciones->render() }}
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
                    text: "Do you really want to delete this seccion?",
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
