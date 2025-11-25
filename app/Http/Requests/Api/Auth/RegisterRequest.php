<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\ApiRequest;


class RegisterRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * rfc: Valida que el formato del correo sea válido según la norma RFC .
     * dns: Verifica que el dominio del correo tenga registros DNS válidos (es decir, que exista realmente un servidor de correo asociado a ese dominio).
     * spoof: Intenta detectar si el correo electrónico podría ser una dirección suplantada.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
            'first_name'          => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'last_name'           => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'country'             => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'city'                => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'birthdate'           => 'required|date',
            'phone'               => 'required|string|max:20|min:7|regex:/^[0-9\+\-\s]+$/',
            'photo'               => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB máximo
            'gender_id'           => 'required|exists:genders,id',
            'document_type_id'    => 'required|exists:document_types,id',
            'user_type_id'        => 'required|exists:user_types,id',
            'modality_id'         => 'required|exists:modalitys,id',
            'document_number'     => 'required|string|max:100|min:3|unique:users,document_number|regex:/^[A-Za-z0-9]+$/',
            'institution_name'    => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'academic_program'    => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'university'          => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'company_name'        => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'company_position'    => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'company_address'     => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\.\'\-#]+$/',
            'entrepreneur_name'   => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'product_type'        => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'occupation'          => 'nullable|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\'-]+$/',
            'accepted_terms'      => 'required|boolean|accepted',
            'email'               => 'required|email:rfc,dns,spoof|unique:users,email',
            'password'            => 'required|string|min:6|confirmed',
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
         // Nombres personalizados para cada campo de la solicitud
        return [
            'first_name'            => 'nombres',
            'last_name'             => 'apellidos',
            'country'               => 'país',
            'city'                  => 'ciudad',
            'phone'                 => 'teléfono',
            'birthdate'             => 'fecha de nacimiento',
            'photo'                 => 'foto de perfil',
            'gender_id'             => 'género',
            'document_type_id'      => 'tipo de documento',
            'user_type_id'          => 'tipo de usuario',
            'modality_id'           => 'modalidad',
            'academic_program_id'   => 'programa académico',
            'document_number'       => 'número de documento',
            'institution_name'      => 'nombre de la institución',
            'academic_program'      => 'programa académico',
            'university'            => 'universidad',
            'company_name'          => 'nombre de la empresa',
            'company_position'      => 'cargo en la empresa',
            'company_address'       => 'dirección de la empresa',
            'entrepreneur_name'     => 'nombre del emprendimiento',
            'product_type'          => 'tipo de producto',
            'occupation'            => 'ocupación',
            'accepted_terms'        => 'términos y condiciones',
            'email'                 => 'correo electrónico',
            'password'              => 'contraseña',
            'password_confirmation' => 'confirmación de contraseña',
        ];
    }
}
