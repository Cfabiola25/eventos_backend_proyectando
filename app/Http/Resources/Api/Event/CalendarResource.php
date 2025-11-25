<?php

namespace App\Http\Resources\Api\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'uuid'         => $this->uuid,
            'title'        => $this->title,
            'image'        => $this->image,
            'description'  => $this->description,
            'max_capacity' => $this->max_capacity,
            'virtual_link' => $this->virtual_link,
            'color'        => $this->color,
            'is_active'    => $this->is_active,
            'modality'     => $this->whenLoaded('modality', function () {
                return [
                    'uuid' => $this->modality->uuid,
                    'name' => $this->modality->name,
                ];
            }),
            'schedules' => $this->whenLoaded('schedules', function () {
                return $this->schedules->map(function ($schedule) {
                    return [
                        'uuid' => $schedule->uuid,
                        'start_date' => Carbon::parse($schedule->start_date)->format('Y-m-d'),
                        'end_date' => Carbon::parse($schedule->end_date)->format('Y-m-d'),
                        'start_time' => Carbon::parse($schedule->start_time)->format('H:i'),
                        'end_time' => Carbon::parse($schedule->end_time)->format('H:i'),
                    ];
                });
            })
        ];
    }
}
