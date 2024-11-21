<?php

namespace App\Http\Controllers;

use App\Http\Requests\FincaStoreRequest;
use App\Models\Finca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FincaController extends Controller
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
                Finca::all()
            );
        }
        $fincas = finca::latest()->paginate(10);

        return view('fincas.index')->with('fincas', $fincas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fincas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FincaStoreRequest $request)
    {
        $finca = Finca::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        if (!$finca) {
            return redirect()->back()->with('error', 'Sorry, No se creo la finca.');
        }

        return redirect()->route('fincas.index')->with('success', 'finca craeda con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(finca $finca)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(finca $finca)
    {
        return view('fincas.edit', compact('finca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, finca $finca)
    {
        $finca->nombre = $request->nombre;
        $finca->descripcion = $request->descripcion;

        if (!$finca->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the finca.');
        }

        return redirect()->route('fincas.index')->with('success', 'Success, la finca ha sido modificada.');
    }

    public function destroy(finca $finca)
    {
        $finca->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
