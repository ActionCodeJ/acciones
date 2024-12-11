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



    <h3>Galeria de Imagenes</h3>



    <div class="row">

    <div class='listado-imagenes  gallery'>



            @if($images->count())

                @foreach($images as $image)

                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>

                    <a class="thumbnail fancybox" rel="ligthbox" href="{{ $image->image_path }}">

                        <img class="img-responsive" alt="" src="{{ $image->image_path }}" />

                        <div class='text-center'>

                            <small class='text-muted'>{{ $image->name}}</small>

                        </div> <!-- text-center / end -->

                    </a>

                    <form action="{{ url('admin/galeria',$image->id) }}" method="POST">

                    <input type="hidden" name="_method" value="delete">

                    {!! csrf_field() !!}

                    <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>

                    </form>

                </div> <!-- col-6 / end -->

                @endforeach

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
