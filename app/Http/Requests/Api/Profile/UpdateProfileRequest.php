<?php

namespace App\Http\Requests\Api\Profile;
use App\Rules\Api\Profile\UserProfilePhotoRule;
use App\Http\Requests\ApiRequest;

class UpdateProfileRequest extends ApiRequest
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
            'photo'               => 'nullable', new UserProfilePhotoRule,
            'password'            => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        // Mensajes de error personalizados para cada regla de validación
        return [
            'date'        => 'El campo :attribute debe ser una fecha válida.',
            'regex'      =>  'El campo :attribute contiene caracteres no permitidos.',
            'required'    => 'El campo :attribute es obligatorio.',
            'string'      => 'El campo :attribute debe ser una cadena de texto.',
            'email'       => 'El campo :attribute debe ser una dirección de correo válida.',
            'email.rfc'   => 'El campo :attribute debe tener un formato RFC válido.',
            'email.dns'   => 'El dominio del :attribute no parece tener un servidor válido.',
            'email.spoof' => 'El campo :attribute parece ser falso o suplantado.',
            'unique'      => 'El campo :attribute ya ha sido registrado.',
            'max'         => 'El campo :attribute no debe exceder los :max caracteres.',
            'min'         => 'El campo :attribute debe tener al menos :min caracteres.',
            'confirmed'   => 'La confirmación de :attribute no coincide.',
            'exists'      => 'El campo :attribute seleccionado no es válido.',
            'boolean'     => 'El campo :attribute debe ser verdadero o falso.',
            'accepted'    => 'Debes aceptar los términos y condiciones.',
            'image'       => 'El archivo de :attribute debe ser una imagen.',
            'mimes'       => 'El archivo de :attribute debe ser de tipo: :values.',
        ];
    }

    public function attributes()
    {
        return [
            'first_name'        => 'nombres',
            'last_name'         => 'apellidos',
            'country'           => 'país',
            'city'              => 'ciudad',
            'birthdate'         => 'fecha de nacimiento',
            'phone'             => 'teléfono',
            'photo'             => 'foto de perfil',
            'password'          => 'contraseña',
        ];
    }
}
