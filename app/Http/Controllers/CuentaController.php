<?php

namespace App\Http\Controllers;

use App\Http\Requests\CuentaStoreRequest;
use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CuentaController extends Controller
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
                Cuenta::all()
            );
        }
        $cuentas = Cuenta::latest()->paginate(10);

        return view('cuentas.index')->with('cuentas', $cuentas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cuentas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CuentaStoreRequest $request)
    {
        $Cuenta = Cuenta::create([
            'numero' => $request->numero,
            'banco' => $request->banco,
            'cbu' => $request->cbu,
            'descripcion' => $request->descripcion,
            'alias' => $request->alias,
            'dolar' => $request->dolar,
        ]);

        if (!$Cuenta) {
            return redirect()->back()->with('error', 'Sorry, No se creo la Cuenta.');
        }

        return redirect()->route('cuentas.index')->with('success', 'Cuenta creada con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $Cuenta)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        return view('cuentas.edit', compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $Cuenta)
    {
        $Cuenta->banco = $request->banco;
        $Cuenta->numero = $request->numero;
        $Cuenta->cbu = $request->cbu;
        $Cuenta->descripcion = $request->descripcion;
        $Cuenta->alias = $request->alias;
        $Cuenta->dolar = $request->dolar;

        if (!$Cuenta->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the Cuenta.');
        }

        return redirect()->route('cuentas.index')->with('success', 'La cuenta ha sido modificada.');
    }

    public function destroy(Cuenta $Cuenta)
    {
        if ($Cuenta->avatar) {
            Storage::delete($Cuenta->avatar);
        }

        $Cuenta->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
