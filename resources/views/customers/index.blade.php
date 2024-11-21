@extends('layouts.admin')

@section('title', 'Pacientes ')
@section('content-header', 'Pacientes ')
@section('content-actions')
    <a href="{{route('customers.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Registar nuevo Paciente</a>
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
                  
                    <th>Contacto</th>
                    <th>Direccion</th>
                    <th>Cuil/T</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{$customer->id}}</td>
                        
                        <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                      
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->address}}</td>
                        <td>{{$customer->cuil}}</td>
                        <td>
                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-success"><i
                                class="fas fa-eye"></i></a>
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('customers.destroy', $customer)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $customers->render() }}
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
                    text: "Do you really want to delete this customer?",
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
