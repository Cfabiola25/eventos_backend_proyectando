<?php

namespace App\Http\Resources\Api\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'        => $this->uuid,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'photo'       => $this->photo,
            'birthdate'   => Carbon::parse($this->birthdate)->format('Y-m-d'),
            'country'     => $this->country,
            'city'        => $this->city,
            'email'       => $this->email,
            'gender_id'   => $this->gender_id,
            'document_number' => $this->document_number,
            'document_type_id' => $this->document_type_id,
            'phone'      => $this->phone,
            'modality' => $this->whenLoaded('modality', function () {
                return [
                    'name' => $this->modality->name,
                ];
            }, null),
        ];
    }
}
