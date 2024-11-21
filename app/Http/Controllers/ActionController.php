<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\ActionEntity;
use App\Models\ActionState;
use App\Models\ActionTeam;
use App\Models\ActionType;
use App\Models\Departamento;
use App\Models\Entity;
use App\Models\Image;
use App\Models\Localidad;
use App\Models\Program;
use App\Models\Project;
use App\Models\Team;

class ActionController extends Controller
{

    public function documentUpload(Action $action)
    {
        
        
       //print_r($action->documentos);
     
        return view('actions.document', compact('action'));
    }

    public function index(Request $request)
    {
        // Iniciamos la consulta para obtener las acciones con la relación de 'localidad' y 'departamento' de la localidad
        $query = Action::orderBy('id', 'desc')->with('localidad.departamento');

        // Verificamos si hay un término de búsqueda
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            // Filtramos las acciones por el contenido de las columnas 'nombre' y 'descripcion', o por el nombre de la localidad
            $query->where('nombre', 'LIKE', "%$search%")
                ->orWhere('descripcion', 'LIKE', "%$search%")
                ->orWhere('fecha', 'LIKE', "%$search%")

                ->orWhereHas('localidad', function ($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%")
                      ->orWhereHas('departamento', function ($q) use ($search) {
                          $q->where('nombre', 'LIKE', "%$search%");
                      });
                })
                ->orWhereHas('entidad', function ($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%");
                });
        }

        // Ejecutamos la consulta y obtenemos las acciones filtradas
        $actions = $query->get();

        // Retornamos la vista con las acciones filtradas
        return view('actions.index', compact('actions'));
    }

    public function index2(Request $request)
    {
        // Iniciamos la consulta para obtener las acciones con la relación de 'localidad'
        $query = Action::orderBy('id',  'desc')->with('localidad');

        // Verificamos si hay un término de búsqueda
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            // Filtramos las acciones por el contenido de las columnas 'nombre' y 'descripcion', o por el nombre de la localidad
            $query->where('nombre', 'LIKE', "%$search%")
                ->orWhere('descripcion', 'LIKE', "%$search%")
                ->orWhereHas('localidad', function ($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%");
                })
                ->orWhereHas('entidad', function ($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%");
                });
        }

        // Ejecutamos la consulta y obtenemos las acciones filtradas
        $actions = $query->get();

        // Retornamos la vista con las acciones filtradas
        return view('actions.index', compact('actions'));
    }

  
  public function secundarios()
  {
        
      
      $entidades = Entity::all();
      $personas = Team::all();

     
      return view('actions.secundarios', compact('personas','entidades'));
  }
  public function secundario(Action $action)
  {
         // Cargar todos los departamentos desde la base de datos
      $localidades = Localidad::all();
      $entidades = Entity::all();
      $personas = Team::all();

      $programs = Program::all();
      $projects = Project::all();
      return view('actions.secundario', compact('action','programs','projects','personas','localidades','entidades'));
  }
    
      // Mostrar el formulario para crear una nueva action
    public function create()
    {
           // Cargar todos los departamentos desde la base de datos
        $localidades = Localidad::all();
        $entidades = Entity::all();
        $personas = Team::all();

        $estados = ActionState::all();
         $tipos = ActionType::all();

        $programs = Program::all();
        $projects = Project::all();
        return view('actions.create', compact('estados','tipos','programs','projects','personas','localidades','entidades'));
    }

      // Almacenar una nueva action
    public function store(Request $request)
    {
      
     
        $request->validate([
            'nombre' => 'required|string|max:255',
            'localidad_id' => 'required|exists:localidades,id'
        ]);

        
        $action = new Action();
        $action->nombre = $request->nombre;
        $action->localidad_id = $request->localidad_id;
        $action->team_id = $request->team_id;
        $action->program_id = $request->program_id;
        $action->project_id = $request->project_id;
        $action->direccion = $request->direccion;
        $action->entity_id = $request->entity_id;
        $action->fecha = $request->fecha;
        $action->codigo = $request->codigo;
        $action->repuesta = $request->repuesta;
        $action->respuesta_fecha = $request->respuesta_fecha;
        $action->telefono = $request->telefono;
        $action->monto_estimado = $request->monto_estimado;
        $action->tags = $request->tags;
        $action->descripcion = $request->descripcion;

        $action->type_id = $request->tipo_id;
        $action->estate_id = $request->estado_id;
        $tags = $request->input('tags');
        // dd($entidades);
        $palabras='' ;
        if (is_array($tags) || is_object($tags))
         {
                 foreach ($tags as $tag) {
                     if(!empty($tag)){
                     
                        $palabras  = $palabras. $tag.' - '  ;
                     }
                 }   
             }   
             $action->tags =  $palabras;
        
        $action->save();
        //return redirect()->route('outlets.create', ['action_id' => $action->id])->with('success', 'Actividad creada correctamente.');
        
        $entidades = $request->input('entidades');
       // dd($entidades);
       if (is_array($entidades) || is_object($entidades))
        {
                foreach ($entidades as $entidad) {
                    if(!empty($entidad)){
                    //echo $entidad;
                        ActionEntity::create([
                            'action_id' =>  $action->id,
                                'entity_id'   =>  $entidad
                            ]);
                    }
                }   
            }   

        $personas = $request->input('teams');
       // dd($personas);
       if (is_array($personas) || is_object($personas))
       {
            foreach ($personas as $entidad) {
                if(!empty($entidad)){
                // echo $entidad->id;
                    ActionTeam::create([
                        'action_id' =>  $action->id,
                            'teams_id'   =>  $entidad
                        ]);
                }
            }   
        }   


        return redirect()->route('actions.show', $action)->with('success', 'Actividad creada correctamente.');

       // return redirect()->route('actions.index')->with('success', 'action creada correctamente.');
    }



    public function show(Action $action)
    {

        $imgQuery = Image::query();
        $imgQuery->where('action_id', '=', $action->id);
        
        $imagenes = $imgQuery->paginate(5);
        
     //  print_r($action->estado);
     
        return view('actions.show', compact('action','imagenes'));
    }

    // Mostrar el formulario para editar una action
    public function edit(action $action)
    {  
        $localidades = Localidad::all();
        $entidades = Entity::all();
        $personas = Team::all();
        $programs = Program::all();
        $projects = Project::all();
       
        return view('actions.edit', compact('action','programs','projects','personas','localidades','entidades'));

    
    }

    // Actualizar una action existente
    public function update(Request $request, action $action)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'localidad_id' => 'required|exists:localidades,id'
        ]);
    
        $action->nombre = $request->nombre;
        $action->localidad_id = $request->localidad_id;
        $action->team_id = $request->team_id;
        $action->program_id = $request->program_id;
        $action->project_id = $request->project_id;
        $action->direccion = $request->direccion;
        $action->entity_id = $request->entity_id;
        $action->fecha = $request->fecha;
        $action->codigo = $request->codigo;
        $action->repuesta = $request->repuesta;
        $action->respuesta_fecha = $request->respuesta_fecha;
        $action->telefono = $request->telefono;
        $action->monto_estimado = $request->monto_estimado;
        $action->tags = $request->tags;
        $action->descripcion = $request->descripcion;
        $action->save();
        $action->secundarios()->delete();
        $action->personas()->delete();

        $entidades = $request->input('entidades');
        // dd($entidades);
        if (is_array($entidades) || is_object($entidades))
        {
            foreach ($entidades as $entidad) {
                if(!empty($entidad)){
                    // echo $entidad;
                    ActionEntity::create([
                        'action_id' =>  $action->id,
                            'entity_id'   =>  $entidad
                        ]);
                }
            }   
        }   
 
         $personas = $request->input('teams');
        // dd($personas);
        if (is_array($personas) || is_object($personas))
        {
            foreach ($personas as $entidad) {
                if(!empty($entidad)){
                    // echo $entidad->id;
                    ActionTeam::create([
                        'action_id' =>  $action->id,
                            'teams_id'   =>  $entidad
                        ]);
                }
            }   
        } 
    
        return redirect()->route('actions.index')->with('success', 'action actualizada correctamente.');
    
    }

    // Eliminar una action
    public function destroy(action $action)
    {
        $action->delete();
        return redirect()->route('actions.index')->with('success', 'action eliminada correctamente.');
    }
}
