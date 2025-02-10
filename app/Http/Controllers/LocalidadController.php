<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localidad;
use App\Models\Departamento;

class LocalidadController extends Controller
{
    public function index(Request $request)
    {
        // Construimos la consulta base con los campos deseados y relaciones
        $query = Localidad::with('departamento')
            ->orderBy('departamento_id', 'asc') // Ordenamos por el ID del departamento
            ->orderBy('nombre', 'asc');         // Luego por el nombre de la localidad

        // Si hay un filtro de búsqueda
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;

            // Aplicamos los filtros en la consulta
            $query->where('nombre', 'LIKE', "%$search%")
                ->orWhereHas('departamento', function ($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%");
                });
        }

        // Ejecutamos la consulta con paginación
        $localidades = $query->get();

        // Retornamos la vista con los datos
        return view('localidades.index', compact('localidades'));
    }
    // Mostrar el formulario para crear una nueva localidad
    public function create()
    {
        // Cargar todos los departamentos desde la base de datos
        $departamentos = Departamento::all();
        return view('localidades.create', compact('departamentos'));
    }

    // Almacenar una nueva localidad
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id'
        ]);


        $localidad = new Localidad();
        $localidad->nombre = $request->nombre;
        $localidad->departamento_id = $request->departamento_id;

        $localidad->save();

        return redirect()->route('localidades.index')->with('success', 'Localidad creada correctamente.');
    }



    public function show(Localidad $localidad)
    {
        return view('localidades.show', compact('localidad'));
    }

    // Mostrar el formulario para editar una localidad
    public function edit(Localidad $localidad)
    {
        $departamentos = Departamento::all();

        // Retorna la vista de edición, pasando la localidad y los departamentos
        return view('localidades.edit', compact('localidad', 'departamentos'));
    }

    // Actualizar una localidad existente
    public function update(Request $request, Localidad $localidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departamentos,id'
        ]);

        $localidad->nombre = $request->nombre;
        $localidad->departamento_id = $request->departamento_id;
        $localidad->save();

        return redirect()->route('localidades.index')->with('success', 'Localidad actualizada correctamente.');
    }

    // Eliminar una localidad
    public function destroy(Localidad $localidad)
    {
        $localidad->delete();
        return redirect()->route('localidades.index')->with('success', 'Localidad eliminada correctamente.');
    }
}
