<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class CityTourStop extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $table = 'city_tour_stops';

    protected $fillable = [
        'uuid',
        'city_tour_id',
        'order',
        'name',
        'description',
        'arrival_time',
        'departure_time',
        'is_active'
    ];

    protected $casts = [
    'is_active' => 'boolean',
    ];

    /**
     * Relación: Una parada pertenece a un City Tour
     */
    public function cityTour()
    {
        return $this->belongsTo(CityTour::class);
    }
}
