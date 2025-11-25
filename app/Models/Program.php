<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class Program extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

        /**
         * Atributos que pueden ser asignados masivamente.
         *
         * @var array
         */
        protected $fillable = [
            'uuid',
            'name',
            'color',
            'is_active',
            'description'
        ];

        /**
         * un evento tiene muchos programas
         */
        public function events()
        {
            return $this->belongsToMany(Event::class, 'event_program')->withTimestamps();
        }


        /**
         * Conversiones de tipos para los atributos.
         *
         * @var array
         */
        protected $casts = [
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
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
