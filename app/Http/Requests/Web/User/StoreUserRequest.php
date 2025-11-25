<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',     
            'document_type_id' => 'required|integer|exists:document_types,id',
            'document_number' => 'required|string|max:50|unique:users,document_number',
            'password' => 'required|string|min:8|confirmed',
            'gender_id' => 'required|integer|exists:genders,id',
            'user_type_id' => 'required|integer|exists:user_types,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
        ];
    }

    
    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'El nombre es obligatorio',
            'last_name.required' => 'El apellido es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'El correo electrónico ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'La confirmación de contraseña no coincide',
            'document_type_id.required' => 'El tipo de documento es obligatorio',
            'document_type_id.exists' => 'El tipo de documento seleccionado no es válido',
            'document_number.required' => 'El número de documento es obligatorio',
            'document_number.unique' => 'Ya existe un usuario con este número de documento y tipo',
            'gender_id.required' => 'El género es obligatorio',
            'gender_id.exists' => 'El género seleccionado no es válido',
            'user_type_id.required' => 'El tipo de usuario es obligatorio',
            'user_type_id.exists' => 'El tipo de usuario seleccionado no es válido',
            'photo.image' => 'El archivo debe ser una imagen válida',
            'photo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o webp',
            'photo.max' => 'La imagen no debe pesar más de 2MB',
            'photo.dimensions' => 'La imagen debe tener entre 100x100 y 2000x2000 píxeles'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'document_type_id' => 'tipo de documento',
            'document_number' => 'número de documento',
            'gender_id' => 'género',
            'user_type_id' => 'tipo de usuario',
            'photo' => 'foto'
        ];
    }
}
