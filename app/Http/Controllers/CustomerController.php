<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // echo (Auth::user()->id.Auth::user()->rol);
        if (Auth::user()->rol =="ADMINISTRADOR") {
           // echo (Auth::user()->rol);
            $customers = Customer::latest()->paginate(10);
        }else
        $customers = Customer::where('user_id',Auth::user()->id)->latest()->paginate(10);

        return view('customers.index')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  $user = auth()->user();
        // var_dump($user->id);

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $dni_path = $impuesto_path = $propiedad_path = $avatar_path = '';

        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('customers', 'public');
        }
        if ($request->hasFile('imagen_dni')) {
            $dni_path = $request->file('imagen_dni')->store('customers', 'public');
        }
        if ($request->hasFile('imagen_impuesto')) {
            $impuesto_path = $request->file('imagen_impuesto')->store('customers', 'public');
        }

        if ($request->hasFile('imagen_propiedad')) {
            $propiedad_path = $request->file('imagen_propiedad')->store('customers', 'public');
        }

        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'departamento' => $request->departamento,
            'localidad' => $request->localidad,
            
            'address' => $request->address,
            'sexo'=> $request->sexo,
            'avatar' => $avatar_path,
            'imagen_dni' => $dni_path,
            'imagen_impuesto' => $impuesto_path,
            'imagen_propiedad' => $propiedad_path,
            'user_id' => $request->user()->id,

            'documento' => $request->documento,
            'cuil' => $request->cuil,

        ]);

        if (!$customer) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while creating customer.');
        }

        return redirect()->route('customers.index')->with('success', 'Nuevo Paciente Registrado !');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->calle = $request->calle;
        $customer->numero = $request->numero;
        $customer->departamento = $request->departamento;
        $customer->localidad = $request->localidad;
        $customer->sexo = $request->sexo;


        // //
        $customer->documento = $request->documento;
        $customer->cuil = $request->cuil;
      

        if ($request->hasFile('imagen_dni')) {
            // Delete old avatar
            if ($customer->imagen_dni) {
                Storage::delete($customer->imagen_dni);
            }
            // Store avatar
            $avatar_path = $request->file('imagen_dni')->store('customers', 'public');
            // Save to Database
            $customer->imagen_dni = $avatar_path;
        }

        if ($request->hasFile('imagen_impuesto')) {
            // Delete old imagen_impuesto
            if ($customer->imagen_impuesto) {
                Storage::delete($customer->imagen_impuesto);
            }
            // Store imagen_impuesto
            $avatar_path = $request->file('imagen_impuesto')->store('customers', 'public');
            // Save to Database
            $customer->imagen_impuesto = $avatar_path;
        }

        if ($request->hasFile('imagen_propiedad')) {
            // Delete old imagen_propiedad
            if ($customer->imagen_propiedad) {
                Storage::delete($customer->imagen_propiedad);
            }
            // Store imagen_propiedad
            $avatar_path = $request->file('imagen_propiedad')->store('customers', 'public');
            // Save to Database
            $customer->imagen_propiedad = $avatar_path;
        }

        if (!$customer->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un imprevisto. por favor ingrese nuevamente los datos.');
        }

        return redirect()->route('customers.index')->with('success', 'Paciente actualizado.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->imagen_propiedad) {
            Storage::delete($customer->imagen_propiedad);
        }
        if ($customer->imagen_impuesto) {
            Storage::delete($customer->imagen_impuesto);
        }
        if ($customer->imagen_dni) {
            Storage::delete($customer->imagen_dni);
        }
        if ($customer->avatar) {
            Storage::delete($customer->avatar);
        }

        $customer->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
