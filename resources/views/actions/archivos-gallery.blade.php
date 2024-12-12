@extends('layouts.admin3')

@section('title', 'Galeria ')
@section('content-header', 'Galeria')

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- References: https://github.com/fancyapps/fancyBox -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>



    <style type="text/css">

    .listado-imagenes {
        padding-left: 0;
        margin-bottom: 20px;
    }
    .gallery

    {

        display: inline-block;

        margin-top: 20px;

    }

    .close-icon{

    	border-radius: 50%;

        position: absolute;

        right: 5px;

        top: -10px;

        padding: 5px 8px;

    }

    .form-image-upload{

        background: #e8e8e8 none repeat scroll 0 0;

        padding: 15px;

    }

    </style>
@section('content')



<div class="container">



    <h3>Galeria de Archivos</h3>

    <div class="row">
        <div class="col-md-12">
            <form method="GET" action="{{ route('archivos.gallery') }}" class="row">
                <div class="col-md-6">
                    <input type="input" name="search" class="form-control" placeholder="Buscar..." value="{{ request()->get('search') }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Buscar </button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">

    <div class='listado-imagenes  gallery'>



            @if($documentos->count())
            <form action="{{ route('archivos.descargar') }}" method="POST" enctype="multipart/form-data">
                @csrf


                @foreach($documentos as $document)

                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>

                    <a class="thumbnail fancybox" rel="ligthbox" href="{{ $document->path }}">

                        <img class="img-responsive" alt="" src="../images/file.png" />

                        <div class='text-center'>

                            <small class='text-muted'>{{ $document->name}}</small>

                        </div> <!-- text-center / end -->

                    </a>


                     <input  class="close-icon btn btn-sucess" type="checkbox" name="numero[]" value="{{ $document->id }}" >

                    

                </div> <!-- col-6 / end -->

                @endforeach
                <button class="btn btn-success btn-block btn-lg" type="submit" onclick="if(!this.form.numero.checked){alert('Para poder descargar por favor seleccione al menos una documentn.');return false}">Descargar documentos Seleccionadas</button>

            </form>


            @endif



        </div> <!-- list-group / end -->

    </div> <!-- row / end -->

</div> <!-- container / end -->



@endsection


@section('js')

<script type="text/javascript">

    $(document).ready(function(){

        $(".fancybox").fancybox({

            openEffect: "none",

            closeEffect: "none"

        });

    });

</script>

@endsection
