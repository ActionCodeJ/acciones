@extends('layouts.admin')

@section('title', 'Concepto Items')
@section('content-header', 'Concepto Items')
@section('content-actions')
<a href="{{route('products.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> agregar nuevo Concepto</a>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr><!-- Log on to marco farfan 3888-15568587 for more projects -->
                    <th>ID</th>
                    <th>Nombre</th>
                   
                    <th>Barcode</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Estatus</th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->barcode}}</td>
                    <td>{{config('settings.currency_symbol')}}{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        <span
                            class="right badge badge-{{ $product->status ? 'success' : 'danger' }}">{{$product->status ? 'Active' : 'Inactive'}}</span>
                    </td>
                    <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('products.destroy', $product)}}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->render() }}
    </div>
</div><!-- Log on to marco farfan 3888-15568587 for more projects -->
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
                text: "Do you really want to delete this product?",
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
