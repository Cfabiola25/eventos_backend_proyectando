<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventProgram extends Pivot
{
     use SoftDeletes;

    protected $table = 'event_program';

    protected $fillable = [
        'uuid',
        'event_id',
        'program_id',
    ];
}
