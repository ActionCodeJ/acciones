<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'especializacion'=>['string','max:2'],
            'calle' => ['string', 'max:255'],
            'numero' => ['string', 'max:255'],
            'departamento' => ['string', 'max:255'],
            'ciudad' => ['string', 'max:255'],
            'pais' => ['string', 'max:255'],
            'codigo_postal' => ['string', 'max:255'],
            'telefono' => ['string', 'max:20'],
            
            'telefono_consultorio' => ['string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
        'first_name.required' => 'Por favor ingrese su nombre', // custom message
        'last_name.required' => 'Por favor ingrese su Apellido', // custom message
        'password.min' => 'La clave debe ser de al menos 8 caracteres', // custom message

        'email.unique' => 'email ya registrado', // custom message
       ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'especializacion'=>$data['especializacion'],
            'email' => $data['email'],
            'calle' => $data['calle'],
            'numero' => $data['numero'],
            'departamento' => $data['departamento'],
            'ciudad' => $data['ciudad'],
            'pais' => $data['pais'],
            'codigo_postal' => $data['codigo_postal'],
            'telefono' => $data['telefono'],
            'telefono_consultorio' => $data['telefono_consultorio'],
            'rol' => 'PENDIENTE',
            'password' => Hash::make($data['password']),
        ]);
    }
}
