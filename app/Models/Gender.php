<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use App\Traits\HasUuid;

class Gender extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, HasUuid, Auditable;

    protected $table = 'genders';

    protected $fillable = ['uuid', 'name', 'is_active'];
}
