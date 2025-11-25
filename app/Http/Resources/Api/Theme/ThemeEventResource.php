<?php

namespace App\Http\Resources\Api\Theme;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ThemeEventResource extends JsonResource
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
            'start_date'  => Carbon::parse($this->start_date)->format('Y-m-d'),
            'description' => $this->description,
            'events'      => $this->whenLoaded('events', function () {
                return $this->events->map(function ($event) {
                    return [
                        'uuid'        => $event->uuid,
                        'title'       => $event->title,
                        'image'       => $event->image,
                        'description' => $event->description,
                        'max_capacity'=> $event->max_capacity,
                        'color'      => $event->color,
                        'modality'    => $event->modality->name ?? null,
                        'schedules'   => $event->schedules->map(function ($schedule) {
                            return [
                                'uuid'       => $schedule->uuid,
                                'start_date' => Carbon::parse($schedule->start_date)->format('Y-m-d'),
                                'end_date'   => Carbon::parse($schedule->end_date)->format('Y-m-d'),
                                'start_time' => Carbon::parse($schedule->start_time)->format('H:i'),
                                'end_time'   => Carbon::parse($schedule->end_time)->format('H:i'),
                            ];
                        }),
                        'speakers'    => $event->speakers->map(function ($speaker) {
                            return [
                                'uuid'        => $speaker->uuid,
                                'name'        => $speaker->name,
                                'profession'  => $speaker->profession,
                                'bio'         => $speaker->bio,
                                'photo'       => $speaker->photo,
                                'website'     => $speaker->website,
                                'social_link' => $speaker->social_link,
                                'is_active'   => $speaker->is_active,
                            ];
                        }),
                        'categories'  => $event->categories->map(function ($category) {
                            return [
                                'id'          => $category->id,
                                'uuid'        => $category->uuid,
                                'name'        => $category->name,
                            ];
                        }),
                    ];
                });
            }),
        ];
    }
}
