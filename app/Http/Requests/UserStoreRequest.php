<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|email |unique:users',
            'password' => 'nullable|string|max:20',
            'rol' => 'nullable|string|max:20',
            
        ];
    }

    public function messages()
    {
         return [
            'email.unique' => 'Ya existe un email asociado. por favor ingrese otro distinto.',
        ];
    }
}
