@extends('layouts.admin2')

@section('title', 'Datos de la action')
@section('content-header', 'Actividad')

@section('content')
    <a href="{{ route('actions.index') }}" class="btn btn-success"><i class="fas fa-eye"> Volver al Listado de
            Actividades</i></a>

            <a href="{{ route('actions.show', $action) }}" class="btn btn-warning"><i class="fas fa-camera"> Imagenes</i></a>
    @if ($action->mapa)
        <a href="{{ route('outlets.edit', $action->mapa) }}" class="btn btn-primary"><i class="fa fa-map-marker"></i> Modificar
            en mapa<i class="fa fa-map-marker"></i></a>
    @else
        <a href="{{ route('outlets.create', ['action_id' => $action->id]) }}" class="btn btn-info"><i
                class="fa fa-map-marker"></i> Registar en mapa<i class="fa fa-map-marker"></i></a>
    @endif


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

                    

                </div>




            </form>

           
            @if (($action->documentos) )
            <div class="alert alert-danger">
                <p>Documentos:</p>
                <ul>
                    @foreach ($action->documentos as $documento)

                 

                    <li><i class="fa fa-file-pdf"></i> <a href="{{ $documento->path }}" alt="{{ $documento->name }}"  target="_blank"> {{ $documento->name }}</a> - <i class="fa fa-trash" aria-hidden="true"></i><button class="btn btn-danger btn-delete"
                        data-url="{{ route('documentUpload.destroy', $documento) }}"><i
                            class="fas fa-trash"></i>Eliminar Documento</button><li>
                    @endforeach
                </ul>
            </div>
            @else 
                <p>Sin Documentos</p>
            @endif


            <div class="container mt-3">
                <h3 class="text-center mb-3" style="color:#45c3f5;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Agregar
                    Documentos <i class="fa fa-file-pdf-o" aria-hidden="true"></i></h3>
                <form action="{{ route('documentUpload') }}" method="post" enctype="multipart/form-data">
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


                        <input type="file" name="documentFile[]" class="custom-file-input" id="documentFile"
                            multiple="multiple">

                        <label class="custom-file-label" for="images" data-browse="Elegir documento">click aqui para Elegir
                            documentos</label>


                    </div>
                    <input name="action_id" type="hidden" value="{{ $action->id }}">
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">
                        Click para Subir los documentos
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
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    
   
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
                    text: "Realmente quiere eliminar este Documento?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, borrar!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        }, function(res) {
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
