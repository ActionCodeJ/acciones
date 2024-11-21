@extends('layouts.admin2')

@section('title', 'Editar action')
@section('content-header', 'Modificar Actividad')

@section('content')

<style>
  
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #cdd3f1;
    border: 1px solid #3c3ff3;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}


.select2-red + .select2-container--default .select2-selection--multiple .select2-selection__choice {
  background-color: #f1a5e5;
  border: 1px solid #d1089f;
  border-radius: 4px;
  cursor: default;
  float: left;
  margin-right: 5px;
  margin-top: 5px;
  padding: 0 5px;
}
</style>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $(".js-example-responsive").select2({
           
           width: 'resolve' // need to override the changed default
         });
        $(".js-example").select2({
           
    width: 'resolve' // need to override the changed default
  });
    });
    
  </script>
<div class="card">
    <div class="card-body">

        <form action="{{ route('actions.update', $action) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                    placeholder="nombre" value="{{ old('nombre', $action->nombre) }}">
                @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="entity_id">Entidad</label>
                <select name="entity_id" class="form-control" required>
                    <!-- Aquí debes cargar los localidads desde tu base de datos -->
                    @foreach ($entidades as $entidad)
                        <option value="{{ $entidad->id }}" {{ $action->entity_id == $entidad->id ? 'selected' : '' }}>
                            {{ $entidad->nombre }} - {{optional($entidad->entidad_padre)->nombre}}
                        </option>
                    @endforeach
                    
                </select>
            </div>
            <div class="form-group">
                <label for="entity_id">Entidades secundarias </label>

                @php 
                $selected = []; ;
               
                foreach($action->secundarios as $entidad){
                    $selected[] = $entidad->entity_id;

                 }
               
              //  print_r ($selected);
                @endphp

<select name="entidades[]" class="form-control js-example-responsive" multiple="multiple" style="width: 95%">

                <!-- select  class="form-control" name="entidades[]" style="width: 100%;" multiple -->
                    <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                    @foreach ($entidades as $entidad)
                        <option value="{{ $entidad->id }}" {{ (in_array($entidad->id, $selected)) ? 'selected ' : '' }}>{{ $entidad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="form-group">
                <label for="team_id">Encargado principal</label>
                <select name="team_id" class="form-control" required>
                    <!-- Aquí debes cargar los localidads desde tu base de datos -->
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}" {{ $action->team_id == $persona->id ? 'selected' : '' }}>
                            {{ $persona->apellido }}, {{ $persona->nombre }}
                        </option>
                    @endforeach
                    
                </select>
            </div>

            <div class="form-group">
                <label for="entity_id">Personas Involucradas</label>

                @php 
               $selected2= [];  ;
                foreach($action->personas as $entidad){
                    $selected2[] = $entidad->teams_id;

                 }
               
             //  print_r ($selected2);
                @endphp
               <select name="teams[]" class="form-control js-example select2-red" multiple="multiple" style="width: 95%">


                <!-- select  class="form-control" name="teams[]" style="width: 100%;" multiple -->
                    <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}" {{ (in_array($persona->id, $selected2)) ? 'selected ' : '' }}>{{ $persona->nombre }}  {{ $persona->apellido }}</option>
                    @endforeach
                </select>
            </div>



           

            <div class="form-group">
                <label for="program_id">Programa</label>
                <select name="program_id" class="form-control" required>
                    <!-- Aquí debes cargar los localidads desde tu base de datos -->
                    @foreach ($programs as $programa)
                        <option value="{{ $programa->id }}" {{ $action->program_id == $programa->id ? 'selected' : '' }}>
                            {{ $programa->nombre }} 
                        </option>
                    @endforeach
                    
                </select>
            </div>


            <div class="form-group">
                <label for="project_id">Proyecto</label>
                <select name="project_id" class="form-control" required>
                    <!-- Aquí debes cargar los localidads desde tu base de datos -->
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $action->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->nombre }} 
                        </option>
                    @endforeach
                    
                </select>
            </div>



            <div class="form-group">
                <label for="localidad_id">localidad</label>
                <select name="localidad_id" class="form-control" required>
                    <!-- Aquí debes cargar los localidads desde tu base de datos -->
                    @foreach ($localidades as $localidad)
                        <option value="{{ $localidad->id }}" {{ $action->localidad_id == $localidad->id ? 'selected' : '' }}>
                            {{ $localidad->nombre }} - {{$localidad->departamento->nombre}}
                        </option>
                    @endforeach
                    
                </select>
            </div>

            <div class="form-group">
                <label for="direccion">direccion</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                    id="direccion" placeholder="direccion" value="{{ old('direccion', $action->direccion) }}">
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="direccion">telefono</label>
                <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                    id="telefono" placeholder="telefono" value="{{ old('telefono', $action->telefono) }}">
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="avatar">avatar</label>
                <input type="text" name="avatar" class="form-control @error('avatar') is-invalid @enderror"
                    id="avatar" placeholder="avatar" value="{{ old('avatar', $action->avatar) }}">
                @error('avatar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="monto_estimado">Monto Estimado</label>
                <input type="text" name="monto_estimado" class="form-control @error('monto_estimado') is-invalid @enderror"
                    id="monto_estimado" placeholder="monto_estimado" value="{{ old('monto_estimado', $action->monto_estimado) }}">
                @error('monto_estimado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="codigo">codigo</label>
                <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                    id="codigo" placeholder="codigo" value="{{ old('codigo', $action->codigo) }}">
                @error('codigo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tags">tags</label>
                <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror"
                    id="tags" placeholder="tags" value="{{ old('tags', $action->tags) }}">
                @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <div class="col-4">
                <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror"
                    id="fecha" placeholder="fecha" value="{{ old('fecha', $action->fecha) }}">
                @error('fecha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>
            <div class="form-group">
                <label for="descripcion">descripcion</label>
                <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                    id="descripcion" placeholder="descripcion" value="{{ old('descripcion', $action->descripcion) }}">
                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="repuesta">repuesta</label>
                <input type="text" name="repuesta" class="form-control @error('repuesta') is-invalid @enderror"
                    id="repuesta" placeholder="repuesta" value="{{ old('repuesta', $action->repuesta) }}">
                @error('repuesta')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="respuesta_fecha">Respuesta_fecha</label>
                <div class="col-4">
                <input type="date" name="respuesta_fecha" class="form-control @error('respuesta_fecha') is-invalid @enderror"
                    id="respuesta_fecha" placeholder="respuesta_fecha" value="{{ old('respuesta_fecha', $action->respuesta_fecha) }}">
                @error('respuesta_fecha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>
          

            <button class="btn btn-success btn-block btn-lg" type="submit">Actualizar Cambios</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection