<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class Event extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $table = 'events';

     protected $fillable = [
        'uuid',
        'title',           // Título del evento
        'image',           // URL de la imagen del evento
        'description',     // Descripción detallada
        'modality_id',     // ID de la modalidad (presencial, virtual, etc.)
        'max_capacity',    // Capacidad máxima de asistentes
        'virtual_link',    // Enlace para eventos virtuales
        'color',           // color del evento
        'is_active'       // Estado de activación
    ];

    /**
     * Accesor para obtener la URL completa de la imagen del evento.
     * @param string $image
     * @return string
     */
    public function getImageAttribute()
    {
        $img = $this->attributes['image'] ?? null;

        return $img 
            ? route('file', ['path' => $img]) 
            : null;
    }

    /**
     * relacion de eventos con los task
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tag');
    }

    /**
     * Un evento puede pertenecer a múltiples categorías.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }

    /**
     * Relación: Un evento pertenece a una modalidad.
     */
    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    /**
     * un evento tiene uno o muchos programas
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'event_program')->withTimestamps();
    }

    /**
     * Relación: Un evento puede tener muchas agendas.
     */
    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    /**
     * Relación: Un evento puede tener muchos temas.
     */
    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'event_theme'); // si deseas modelo intermedio
    }

    /**
     * Un evento puede tener múltiples horarios en diferentes ubicaciones
     */
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'event_schedule_location'); // Incluir timestamps del pivot
    }

    /**
     * Un evento puede realizarse en múltiples ubicaciones con diferentes horarios
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'event_schedule_location'); // Incluir timestamps del pivot
    }

     /**
     * Un evento puede tener múltiples speakers
     */
    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    /**
     * Relación many-to-many con Speaker incluyendo eliminados (para administración)
     */
    public function speakersWithTrashed()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    
    /**
     * Relación: Un evento puede tener muchas asistencias.
     */
    public function eventAttendances()
    {
        return $this->hasMany(EventAttendance::class);
    }

    /**
     * Relación: Un evento puede tener muchos registros a través de RegistrationEvent.
     */
    public function registrationEvents()
    {
        return $this->hasMany(RegistrationEvent::class);
    }

    /**
     * Conversiones de tipos para los atributos.
     *
     * @var array
     */
    protected $casts = [
        'is_active'    => 'boolean',
        'max_capacity' => 'integer',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    /**
     * Valores por defecto para los atributos.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
    ];

   }
