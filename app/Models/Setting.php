<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class Setting extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $table = 'settings';

    protected $fillable = [
        'name',
        'is_active',
        'description',
        'user_id',
    ];

    /**Relación: Un setting pertenece a un usuario. */
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
