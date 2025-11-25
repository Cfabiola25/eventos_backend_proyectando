<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class Registration extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    /**
     * Nombre de la tabla.
     */
    protected $table = 'registrations';

    /**
     * Campos asignables en masa.
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'subscription_plan_id',
        'status',
        'notes',
    ];

  
    /* ============================
     * RELACIONES
     * ============================
     */

    /**
     * Relación con el usuario.
     * Ejemplo: Juan Pérez realizó esta inscripción.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el plan de suscripción.
     * Ejemplo: "Plan Full Presencial".
     */
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    /**
     * Relación con los eventos seleccionados en la inscripción.
     * Ejemplo: Taller de IA, Conferencia Blockchain.
     */
    public function events()
    {
        return $this->hasMany(RegistrationEvent::class);
    }

    /**
     * Relación con los city tours seleccionados en la inscripción.
     * Ejemplo: "Recorrido Histórico por Cúcuta".
     */
    public function cityTours()
    {
        return $this->hasMany(RegistrationCityTour::class);
    }

}
