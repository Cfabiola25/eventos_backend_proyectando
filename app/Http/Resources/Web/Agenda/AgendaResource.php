<?php

namespace App\Http\Resources\web\Agenda;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
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
            'title' => $this->title,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'start_time' => $this->start_time?->format('H:i:s'),
            'end_time' => $this->end_time?->format('H:i:s'),
            'description' => $this->description
        ];
    }
}
