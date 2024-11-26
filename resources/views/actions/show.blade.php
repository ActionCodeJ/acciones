@extends('layouts.admin')

@section('title', 'Datos de la action')
@section('content-header', 'Actividad')

@section('content')
    <a href="{{ route('actions.index') }}" class="btn btn-success"><i class="fas fa-eye"> Volver al Listado de
            Actividades</i></a>
    @if ($action->mapa)
        <a href="{{ route('outlets.edit', $action->mapa) }}" class="btn btn-info"><i class="fa fa-map-marker"></i> Modificar
            en mapa<i class="fa fa-map-marker"></i></a>
    @else
        <a href="{{ route('outlets.create', ['action_id' => $action->id]) }}" class="btn btn-info"><i
                class="fa fa-map-marker"></i> Registar en mapa<i class="fa fa-map-marker"></i></a>
    @endif

    <a href="{{ route('actions.documentUpload',  $action->id) }}" class="btn btn-danger"><i
        class="fa fa-file-pdf-o"></i> Registar Documentos<i class="fa fa-file-pdf"></i></a>

    <div class="card">
        <div class="card-body">
            {{-- aqui la ruto esta rara del accion, es mas no tendria accion porque es un show --}}
            <form action="{{ route('actions.show', $action) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group col-lg-12 col-12">
                    <div class="form-group">
                        <label for="programa">
                            <strong>Actividad:</strong>
                        </label>
                    <input type="text" name="nombre" class="form-control" id="first_name" placeholder="Nombre" disabled
                        value="{{ old('Nombre', $action->nombre) }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="programa">
                            <strong>Localidad:</strong>
                        </label>
                    <input type="text" name="localidad" class="form-control" id="localidad" placeholder="Localidad"
                        disabled
                        value="{{ old('Localidad',  $action->localidad->nombre . ' - ' . $action->localidad->departamento->nombre) }}">
                    </div>
                    <div class="form-group">
                        <label for="programa">
                            <strong>Entidad Responsable:</strong>
                        </label>
                    <input type="text" name="entidad" class="form-control" id="entidad" placeholder="entidad" disabled
                        value="{{ old('Entidad', $action->entidad->nombre . ' - ' . optional($action->entidad->entidad_padre)->nombre) }}">
                    </div>


                    <div class="form-group">
                        <label for="programa">
                            <strong>Entidad secundarias:</strong>
                        </label>
                        

                     @if (empty($action->secundarios ) ||(count($action->secundarios) < 1) )
                     <div class="alert alert-danger">
                         <ul>
                            
                                 <li>NO hay Entidad secundarias </li>
                             
                         </ul>
                     </div>
                 @else
                 <div class="alert alert-primary">
                     <ul><li> 
                     @foreach($action->secundarios as $persona)
                     
                            
                                 {{$persona->entity->nombre}} -
                             
                        

                            
                     @endforeach  
                     </li> 
                     </ul>
                 </div>
                     @endif
                  </div>


                    <div class="form-group">
                        <label for="programa">
                            <strong>Responsable:</strong>
                        </label>
                    <input type="text" name="responsable" class="form-control" id="responsable"
                        placeholder="rensponsable" disabled
                        value="{{ old('Responsable', $action->team->nombre . ', ' . $action->team->apellido) }}">
                    </div>


                    <div class="form-group">
                        <label for="programa">
                            <strong>Responsable secundarias:</strong>
                        </label>
                    @if (empty($action->personas ) ||(count($action->personas) < 1) )
                        <div class="alert alert-danger">
                            <ul>
                               
                                    <li>NO hay Responsable secundarias </li>
                                
                            </ul>
                        </div>
                    @else
                    <div class="alert alert-primary">
                        <ul><li> 
                        @foreach($action->personas as $persona)
                        
                               
                                    {{$persona->team->nombre}} -
                                
                           

                               
                        @endforeach  
                        </li> 
                        </ul>
                    </div>
                        @endif
                     </div>

                     @if (!empty($action->estado )  )
                  
                     <div class="form-group">
                        <label for="estado">
                            <strong>Estado:</strong>
                        </label>
                        <input type="text" name="estado" class="form-control" id="estado" placeholder="estado"
                            disabled value="{{ old('estado', $action->estado->nombre) }}">
                    </div>
                    @endif
                    @if (!empty($action->tipo )  )
                    <div class="form-group">
                        <label for="Tipo">
                            <strong>Tipo:</strong>
                        </label>
                        <input type="text" name="tipo" class="form-control" id="tipo" placeholder="tipo"
                            disabled value="{{ old('tipo', $action->tipo->nombre) }}">
                    </div>

                    @endif
                    <div class="form-group">
                        <label for="programa">
                            <strong>Programa:</strong>
                        </label>
                        <input type="text" name="programa" class="form-control" id="programa" placeholder="programa"
                            disabled value="{{ old('programa', $action->program->nombre) }}">
                    </div>
                    <div class="form-group">
                        <label for="programa">
                            <strong>Proyecto:</strong>
                        </label>
                    <input type="text" name="proyecto" class="form-control" id="proyecto" placeholder="proyecto"
                        disabled value="{{ old('Proyecto:', $action->project->nombre) }}">
                    </div>

                    <div class="form-group">
                        <label for="programa">
                            <strong>Direccion:</strong>
                        </label>
                    <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion"
                        disabled
                        value="{{ old('direccion:', $action->direccion . '- Telefono:  ' . $action->telefono) }}">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">
                            <strong>Descripción de la actividad:</strong>
                        </label>
                        <textarea name="descripcion" class="form-control" id="descripcion" placeholder="Descripción de la actividad" disabled rows="4">
                            {{ old('descripcion', $action->descripcion . "\n- Código: " . $action->codigo) }}
                        </textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="programa">
                            <strong>palabas Claves:</strong>
                        </label>
                    <input type="text" name="tags" class="form-control" id="tags" placeholder="tags"
                        disabled
                        value="{{ old('tags:', $action->tags) }}">
                    </div>
                </div>




            </form>

            @if (count($imagenes) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($imagenes as $imagen)
                        <li> <a href="{{ $imagen->image_path }}" alt="{{ $imagen->name }}"  target="_blank"><img src="{{ $imagen->image_path }}" alt="{{ $imagen->name }}" width="400" height="400">


                        </a>
                            - <i class="fa fa-trash" aria-hidden="true"></i><button class="btn btn-danger btn-delete"
                            data-url="{{ route('image.destroy', $imagen) }}"><i
                                class="fas fa-trash"></i>Eliminar imagen</button>
             
                    </li> 
                        
                        

                            @endforeach
                    </ul>
                </div>
            @endif



            <div class="container mt-3">
                <h3 class="text-center mb-3" style="color:#c7f8c7;"><i class="fa fa-camera" aria-hidden="true"></i> Agregar
                    Fotos <i class="fa fa-picture-o" aria-hidden="true"></i></h3>
                <form action="{{ route('imageUpload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="user-image mb-3 text-center">
                        <div class="imgPreview"> </div>
                    </div>

                    <div class="custom-file">


                        <input type="file" name="imageFile[]" class="custom-file-input" id="images"
                            multiple="multiple">

                        <label class="custom-file-label" for="images" data-browse="Elegir imagen">click aqui para Elegir
                            imagen</label>


                    </div>
                    <input name="action_id" type="hidden" value="{{ $action->id }}">
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">
                        Click para Subir las imágenes
                    </button>
                </form>
            </div>
        </div>



    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img width="200" height="100" >')).attr('src', event.target
                                .result).appendTo(imgPreviewPlaceholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>


<script>
    $(document).ready(function() {


        setTimeout(function(){
        $("div.alert-success").remove();
        }, 8000 ); //remueve los mensajes de alerta  8 secs


        $(document).on('click', '.btn-delete', function() {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Seguro?',
                text: "Realmente quiere eliminar esta Imagen?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, borrar!',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    alert($this.data('url'));
                    $.post($this.data('url'), {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    }, function(res) {
                        alert(res);
                        $this.closest('li').fadeOut(500, function() {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>



@endsection
