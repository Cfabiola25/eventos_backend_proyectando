<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'uuid'            => $this->uuid,
            'first_name'      => $this->first_name,
            'last_name'       => $this->last_name,
            'email'           => $this->email,
            'country'         => $this->country,
            'city'            => $this->city,
            'birthdate'       => $this->birthdate,
            'photo'           => $this->photo,
            'phone'           => $this->phone,
            'document_number' => $this->document_number,
            'modality' => $this->whenLoaded('modality', function () {
                return [
                    'id'   => $this->modality->id,
                    'name' => $this->modality->name,
                ];
            }, null),
        ];
    }
}
