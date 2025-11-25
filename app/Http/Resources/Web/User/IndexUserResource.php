<?php

namespace App\Http\Resources\Web\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'birthdate' => $this->birthdate,
            'photo' => $this->photo,
            'gender' => $this->gender ? $this->gender->name : null,
            'gender_id' => $this->gender_id,
            'document_type' => $this->documentType ? $this->documentType->name : null,
            'document_type_id' => $this->document_type_id,
            'user_type' => $this->userType ? $this->userType->name : null,
            'user_type_id' => $this->user_type_id,
            'document_number' => $this->document_number,
            'institution_name' => $this->institution_name,
            'academic_program' => $this->academic_program,
            'modality' => $this->modality,
            'university' => $this->university,
            'company_name' => $this->company_name,
            'company_position' => $this->company_position,
            'company_address' => $this->company_address,
            'entrepreneur_name' => $this->entrepreneur_name,
            'product_type' => $this->product_type,
            'occupation' => $this->occupation,
            'status' => $this->status,
            'status_label' => $this->status ? 'Activo' : 'Inactivo',
            'accepted_terms' => $this->accepted_terms,
            'is_admin' => $this->is_admin,
            'is_paid' => $this->is_paid,
            'is_paid_label' => $this->is_paid ? 'Pagado' : 'Pendiente pago',
            'accepted_terms_label' => $this->accepted_terms ? 'Aceptado' : 'Pendiente',
            'roles' => $this->roles->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'color_class' => $this->getRoleColorClass($role->name)
                ];
            }),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),

            // Campos calculados
            'age' => $this->birthdate ? \Carbon\Carbon::parse($this->birthdate)->age : null,
            'initials' => strtoupper(substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1)),
            'full_name' => $this->first_name . ' ' . $this->last_name,

            // Información específica por tipo de usuario
            'user_type_specific_info' => $this->getUserTypeSpecificInfo()
        ];
    }

    /**
     * Obtiene la clase de color para el rol
     */
    private function getRoleColorClass(string $roleName): string
    {
        return match ($roleName) {
            'Super Admin' => 'bg-red-100 text-red-800',
            'Admin Organizador' => 'bg-blue-100 text-blue-800',
            'Expositor' => 'bg-yellow-100 text-yellow-800',
            'Asistente' => 'bg-green-100 text-green-800',
            'Invitado' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Obtiene información específica según el tipo de usuario
     */
    private function getUserTypeSpecificInfo(): array
    {
        switch ($this->user_type_id) {
            case 1: // Estudiante
                return [
                    'type' => 'Estudiante',
                    'institution' => $this->institution_name,
                    'program' => $this->academic_program,
                    'modality' => $this->modality
                ];

            case 2: // Profesional
                return [
                    'type' => 'Profesional',
                    'occupation' => $this->occupation,
                    'university' => $this->university
                ];

            case 3: // Empresario
                return [
                    'type' => 'Empresario',
                    'company' => $this->company_name,
                    'position' => $this->company_position,
                    'address' => $this->company_address
                ];

            case 4: // Emprendedor
                return [
                    'type' => 'Emprendedor',
                    'venture_name' => $this->entrepreneur_name,
                    'product_type' => $this->product_type
                ];

            default:
                return ['type' => 'No especificado'];
        }
    }
}
