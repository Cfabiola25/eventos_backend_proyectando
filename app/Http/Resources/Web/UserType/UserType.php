<?php

namespace App\Http\Resources\Web\UserType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserType extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'type' => $this->type,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'status_text' => $this->is_active ? 'Activo' : 'Inactivo',
            'status_class' => $this->is_active ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100',
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i'),
        ];
    }
}