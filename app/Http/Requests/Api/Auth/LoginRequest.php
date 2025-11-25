<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\ApiRequest;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' =>  ['required', 'string', 'min:6'],
        ];
    }

    /**
     * Get the custom error messages for the validation rules.
     */
    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
        ];
    }

    /**
     * Get the custom attribute names for the validation rules.
     */
    public function attributes()
    {
        return [
            'email' => 'dirección de correo electrónico',
            'password' => 'contraseña'
        ];
    }
}
