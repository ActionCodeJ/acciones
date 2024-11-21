@extends('layouts.admin')

@section('title', 'fincas ')
@section('content-header', 'fincas ')

@section('content-actions')

    <a href="{{route('fincas.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Registar nueva finca</a>
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
                    
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($fincas as $finca)
                    <tr>
                        <td>{{$finca->id}}</td>
                        
                        <td>{{$finca->nombre}}</td>
                        <td>{{$finca->descripcion}}</td>
                       
                        
                        <td>
                            <a href="{{ route('fincas.edit', $finca) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('fincas.destroy', $finca)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $fincas->render() }}
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
                    text: "Do you really want to delete this finca?",
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
