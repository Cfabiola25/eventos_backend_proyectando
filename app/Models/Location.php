<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class Location extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $table = 'locations';


       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'room',
        'address',
        'image',
        'reference_point',
        'latitude',
        'longitude',
        'google_maps_link',
        'country',
        'city',
        'is_active'
    ];

    /**
     * Obtener la URL completa de la imagen de la localización.
     * @return string|null
     */
    public function getImageAttribute()
    {
        $image = $this->attributes['image'] ?? null;

        return $image 
            ? route('file', ['path' => $image]) 
            : null;
    }

    /**
     * Relación many-to-many con Event a través de la tabla pivot
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_schedule_location');
    }

    /**
     * Relación many-to-many con Schedule a través de la tabla pivot
     */
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'event_schedule_location');
    }

    /**
     * Relación uno-a-muchos con EventScheduleLocation
     */
    public function eventSchedules()
    {
        return $this->hasMany(EventScheduleLocation::class);
    }


    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
    ];

}
