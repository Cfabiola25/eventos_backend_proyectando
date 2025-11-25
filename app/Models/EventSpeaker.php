<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Illuminate\Support\Str;

class EventSpeaker extends Pivot implements AuditableContract
{
    use HasFactory, SoftDeletes, Auditable;

    protected $table = 'event_speaker';

    protected $fillable = [
        'uuid',
        'event_id',
        'speaker_id'
    ];

    /**
    * Indica que el pivot tiene timestamps
    */
    public $timestamps = true;

    /**
     * Boot del modelo para generar UUID automáticamente
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
