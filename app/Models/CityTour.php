<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class CityTour extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $fillable = [
        'uuid',
        'name',            // Nombre del tour
        'description',     // Descripción detallada
        'tour_date',       // Fecha del tour
        'tour_time',       // Hora de inicio
        'max_capacity'    // Capacidad máxima
    ];

    /**
     * Conversiones de tipos para los atributos.
     *
     * @var array
     */
    protected $casts = [
        'tour_date'    => 'date:Y-m-d',
        'tour_time'    => 'datetime:H:i:s',
        'max_capacity' => 'integer',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    /**
     * Relación: Un tour en ciudad puede tener varios precios.
     */
    public function cityTourPrices()
    {
        return $this->hasMany(CityTourPrice::class);
    }

    /**
     * Relación: Un tour en ciudad puede estar asociado a varios planes de suscripción.
     */
    public function subscriptionPlanCityTours()
    {
        return $this->hasMany(SubscriptionPlanCityTour::class);
    }
}
