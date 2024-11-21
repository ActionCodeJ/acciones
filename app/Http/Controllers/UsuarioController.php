<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = new User();

        if ($request->nombre) {
            $users = $users->where('first_name', 'LIKE', '%'.$request->nombre.'%');
        }
        if ($request->apellido) {
            $users = $users->where('last_name', 'LIKE', '%'.$request->apellido.'%');
        }
      
        $users = $users->latest()->paginate(20);

        //$users = User::latest()->paginate(10);

        return view('usuarios.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $User = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'rol' => $request->rol,

            'password' => Hash::make($request->password),
            'calle'=>$request->calle,
            'numero'=>$request->numero,
            'departamento'=>$request->departamento,
            'ciudad'=>$request->ciudad,
            'pais'=>$request->pais,
            'codigo_postal'=>$request->codigo_postal,

            'telefono'=>$request->telefono,
            'telefono_consultorio'=>$request->telefono_consultorio,
     



        ]);

        if (!$User) {
            return redirect()->back()->with('error', ' No se logor registrar el usuario.');
        }

        return redirect()->route('usuarios.index')->with('success', 'usuario creado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // echo 'usuarios.index:::::::::::::::'.$user;
        $user->first_name = $user->first_name;
        $user->last_name = $user->last_name;
        $user->email = $user->email;
        $user->rol = 'COMUN';
        $user->calle = $user->calle;
        $user->numero = $user->numero;
        $user->departamento = $user->departamento;
        $user->ciudad = $user->ciudad;
        $user->pais = $user->pais;
        $user->codigo_postal = $user->codigo_postal;

        $user->telefono =$user->telefono;
        $user->telefono_consultorio = $user->telefono_consultorio;
       


        if (!$user->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the User.');
        }

        return redirect()->route('usuarios.index')->with('success', $user->first_name.' '.$user->last_name.' - Cuenta Activada, la cuenta ha sido modificada para ingresar al sistema.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return view('usuarios.edit')->with('user', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            
        ],
        [
           'email.required' => 'El Email es obligatorio',
  'email.max' => 'El Email no debe exceder los 128 caracteres',
  'email.unique' => 'Ya existe un usuario con este Email',
        ]
     );
       
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->rol = $request->rol;
        $user->password = Hash::make($request->password);
        $user->calle = $request->calle;
        $user->numero = $request->numero;
        $user->departamento = $request->departamento;
        $user->ciudad = $request->ciudad;
        $user->pais = $request->pais;
        $user->codigo_postal = $request->codigo_postal;
        $user->telefono= $request->telefono;
        $user->telefono_consultorio= $request->telefono_consultorio;
        

        if (!$user->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the User.');
        }

        return redirect()->route('usuarios.index')->with('success', 'Success, la cuenta ha sido modificada.');
    }

    public function destroy(User $user)
    {

       // echo($user->id);
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        $user->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
