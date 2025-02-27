<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entity;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
        return Validator::make(
            $data,
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'documento' => ['string', 'max:255'],
                'telefono' => ['string', 'max:20'],
                'entity_id' => ['integer'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
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
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'entity_id' => $data['entity_id'],
            'documento' => $data['documento'],
            'rol' => 'PENDIENTE',
            'password' => Hash::make($data['password']),
        ]);
    }
    public function showRegistrationForm()
    {   $entities = Entity::orderBy('nombre', 'asc')->get();
        return view('auth.register', compact('entities'));
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // No iniciar sesión automáticamente
        return redirect()->route('login')->with('success', 'Registro exitoso. Por favor, inicie sesión.');
    }
}
