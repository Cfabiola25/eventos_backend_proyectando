<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class RegistrationCityTour extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $table = 'registration_city_tour';

    protected $fillable = [
        'uuid',
        'registration_id',
        'city_tour_id',
        'quantity',
        'status',
    ];

    /**
     * Relación: un registro de inscripción puede tener muchos city tours.
     * Ej: La inscripción #10 incluye el City Tour #2.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    /**
     * Relación: el city tour asociado a esta inscripción.
     * Ej: "Recorrido Histórico por Cúcuta".
     */
    public function cityTour()
    {
        return $this->belongsTo(CityTour::class);
    }
}
