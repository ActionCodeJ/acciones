<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorStoreRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProveedorController extends Controller
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
                Proveedor::all()
            );
        }
        $proveedors = Proveedor::latest()->paginate(10);

        return view('proveedores.index')->with('proveedores', $proveedors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorStoreRequest $request)
    {
        $avatar_path = '';

        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('proveedors', 'public');
        }

        $proveedor = Proveedor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatar_path,
            'user_id' => $request->user()->id,

            'cuil' => $request->cuil,
            'codigoPostal' => $request->codigoPostal,
            'ctaBanco' => $request->ctaBanco,
            'ctaPesos' => $request->ctaPesos,
            'ctaBonos' => $request->ctaBonos,
            'codigoBanco' => $request->codigoBanco,

            'cbu' => $request->cbu,
            'alias' => $request->alias,
            'tipo' => $request->tipo,
            'iva' => $request->iva,

            'ingresosBrutos' => $request->ingresosBrutos,
            'ingresosBrutosNro' => $request->ingresosBrutosNro,
            'ganancias' => $request->ganancias,
            'gananciasNro' => $request->gananciasNro,
            'tipoRazonSocial' => $request->tipoRazonSocial,
            'cedulaFiscal' => $request->cedulaFiscal,
        ]);

        if (!$proveedor) {
            return redirect()->back()->with('error', 'Ocurrio un imprevisto por favor ingrese nuevamente los datos del proveedor.');
        }

        return redirect()->route('proveedores.index')->with('success', 'Nuevo proveedor registrado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(proveedor $proveedor)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, proveedor $proveedor)
    {
        $proveedor->first_name = $request->first_name;
        $proveedor->last_name = $request->last_name;
        $proveedor->email = $request->email;
        $proveedor->phone = $request->phone;
        $proveedor->address = $request->address;

        $proveedor->cuil = $request->cuil;
        $proveedor->codigoPostal = $request->codigoPostal;
        $proveedor->ctaBanco = $request->ctaBanco;
        $proveedor->ctaPesos = $request->ctaPesos;
        $proveedor->ctaBonos = $request->ctaBonos;
        $proveedor->codigoBanco = $request->codigoBanco;

        $proveedor->cbu = $request->cbu;
        $proveedor->alias = $request->alias;
        $proveedor->tipo = $request->tipo;
        $proveedor->iva = $request->iva;

        $proveedor->ingresosBrutos = $request->ingresosBrutos;
        $proveedor->ingresosBrutosNro = $request->ingresosBrutosNro;
        $proveedor->ganancias = $request->ganancias;
        $proveedor->gananciasNro = $request->gananciasNro;
        $proveedor->tipoRazonSocial = $request->tipoRazonSocial;
        $proveedor->cedulaFiscal = $request->cedulaFiscal;
        $proveedor->user_id = $request->user()->id;

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($proveedor->avatar) {
                Storage::delete($proveedor->avatar);
            }
            // Store avatar
            $avatar_path = $request->file('avatar')->store('proveedors', 'public');
            // Save to Database
            $proveedor->avatar = $avatar_path;
        }

        if (!$proveedor->save()) {
            return redirect()->back()->with('error', 'Ocurrio un imprevisto por favor ingrese nuevamente los datos del proveedor.');
        }

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado.');
    }

    public function destroy(proveedor $proveedor)
    {
        if ($proveedor->avatar) {
            Storage::delete($proveedor->avatar);
        }

        $proveedor->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
