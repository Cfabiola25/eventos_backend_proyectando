<?php

namespace App\Http\Requests\Api\Program;

use App\Http\Requests\ApiRequest;

class AcademiProgramIndexRequest extends ApiRequest
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
     * "start_date": "2025-10-20",
     *"end_date": "2025-10-21"
     */
    public function rules(): array
    {
        return [
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date'   => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
        ];
    }

     public function messages(): array
    {
        return [
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'date_format' => 'El campo :attribute debe tener el formato YYYY-MM-DD.',
            'before_or_equal' => 'El campo :attribute no puede ser mayor que la fecha de fin.',
            'after_or_equal' => 'El campo :attribute no puede ser menor que la fecha de inicio.'
        ];
    }

    public function attributes(): array
    {
        return [
            'start_date' => 'fecha de inicio',
            'end_date'   => 'fecha de fin',
        ];
    }

}
