<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeccionStoreRequest;
use App\Models\Area;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return response(
                Seccion::all()
            );
        }
        $seccions = Seccion::latest()->paginate(10);

        return view('secciones.index')->with('secciones', $seccions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();

        return view('secciones.create')->with('areas', $areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionStoreRequest $request)
    {
        $seccion = Seccion::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'area_id' => $request->area_id,
            'user_id' => 1,
        ]);

        if (!$seccion) {
            return redirect()->back()->with('error', 'Sorry, No se creo la seccion.');
        }

        return redirect()->route('secciones.index')->with('success', 'seccion craeda con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(seccion $seccion)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Seccion $seccion)
    {
        $areas = Area::all();

        // return view('secciones.create')->with('areas', $areas);
        return view('secciones.edit', compact('seccion'))->with('areas', $areas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, seccion $seccion)
    {
        $seccion->nombre = $request->nombre;
        $seccion->descripcion = $request->descripcion;
        $seccion->area_id = $request->area_id;

        if (!$seccion->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the seccion.');
        }

        return redirect()->route('secciones.index')->with('success', 'Success, la seccion ha sido modificada.');
    }

    public function destroy(seccion $seccion)
    {
        $seccion->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
