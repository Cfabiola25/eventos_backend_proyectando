<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class RegistrationEvent extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $table = 'registration_event';

    protected $fillable = [
        'uuid',
        'registration_id',
        'event_id'
    ];

    /**
     * Relación con la inscripción general (Registration).
     * Ejemplo: Inscripción #15 incluye este evento.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    /**
     * Relación con el evento elegido.
     * Ejemplo: Conferencia "IA aplicada a negocios".
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relación: Un registro puede tener una asistencia confirmada
     */
    public function attendance()
    {
        return $this->hasOne(EventAttendance::class, 'registration_event_id');
    }
}
