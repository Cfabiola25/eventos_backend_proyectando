<?php

namespace App\Http\Resources\Api\Program;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProgramIndexResource extends JsonResource
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
            'name'        => $this->name,
            'color'       => $this->color,
            'events'    => $this->whenLoaded('events', function () {
                return $this->events->map(function ($event) {
                    return [
                        'uuid'            => $event->uuid,
                        'title'           => $event->title,
                        'image'           => $event->image,
                        'modality'        => $event->modality->name ?? null,
                        'locations'    => $event->locations->map(function ($location) {
                            return [
                                'uuid' => $location->uuid,
                                'name' => $location->name,
                            ];
                        }),
                        'schedules'    => $event->schedules->map(function ($schedule) {
                            return [
                                'uuid' => $schedule->uuid,
                                'start_date' => Carbon::parse($schedule->start_date)->format('Y-m-d'),
                                'end_date'   => Carbon::parse($schedule->end_date)->format('Y-m-d'),
                                'start_time' => Carbon::parse($schedule->start_time)->format('H:i'),
                                'end_time'   => Carbon::parse($schedule->end_time)->format('H:i'),
                            ];
                        }),
                    ];
                });
            }),
        ];
    }
}
