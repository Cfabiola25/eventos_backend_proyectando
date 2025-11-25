<?php

namespace App\Http\Resources\Api\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class IndexEventResource extends JsonResource
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
            
            // Relación modality
            'modality'     => $this->whenLoaded('modality', function () {
                return [
                    'uuid' => $this->modality->uuid,
                    'name' => $this->modality->name,
                ];
            }),
            
            // Relación schedules
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
            }),
            
            // Relación speakers
            'speakers' => $this->whenLoaded('speakers', function () {
                return $this->speakers->map(function ($speaker) {
                    return [
                        'uuid' => $speaker->uuid,
                        'name' => $speaker->name,
                        'profession' => $speaker->profession,
                        'bio' => $speaker->bio,
                        'photo' => $speaker->photo,
                        'skills' => $speaker->skills,
                        'phone' => $speaker->phone,
                        'website' => $speaker->website,
                        'social_link' => $speaker->social_link,
                        'is_active' => $speaker->is_active,
                    ];
                });
            }),
            
            // Relación locations
            'locations' => $this->whenLoaded('locations', function () {
                return $this->locations->map(function ($location) {
                    return [
                        'uuid' => $location->uuid,
                        'name' => $location->name,
                        'room' => $location->room,
                        'address' => $location->address,
                        'image' => $location->image,
                        'reference_point' => $location->reference_point,
                        'latitude'   => $location->latitude,
                        'longitude' => $location->longitude,
                        'google_maps_link' => $location->google_maps_link,
                        'country' => $location->country,
                        'city' => $location->city,
                        'is_active' => $location->is_active,
                    ];
                });
            }),
            
            // Relación tags
            'tags' => $this->whenLoaded('tags', function () {
                return $this->tags->map(function ($tag) {
                    return [
                        'uuid' => $tag->uuid,
                        'name' => $tag->name,
                        'color' => $tag->color,
                        'is_active' => $tag->is_active,
                    ];
                });
            }),

            // Relación themes
            'themes' => $this->whenLoaded('themes', function () {
                return $this->themes->map(function ($theme) {
                    return [
                        'uuid' => $theme->uuid,
                        'name' => $theme->name,
                        'start_date' => $theme->start_date ? Carbon::parse($theme->start_date)->format('Y-m-d') : null,
                        'description' => $theme->description,
                    ];
                });
            }),

            // Relación categories
            'categories'  => $this->whenLoaded('categories', function () {
                return $this->categories->map(function ($category) {
                    return [
                        'uuid'  => $category->uuid,
                        'name'  => $category->name,
                    ];
                });
            }),

        ];
    }
}
