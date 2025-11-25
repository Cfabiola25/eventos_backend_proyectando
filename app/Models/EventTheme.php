<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTheme extends Pivot
{
     use SoftDeletes;

    protected $table = 'event_theme';

    protected $fillable = [
        'uuid',
        'event_id',
        'theme_id',
    ];
}
