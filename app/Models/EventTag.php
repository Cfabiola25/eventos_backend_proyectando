<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EventTag extends Pivot
{
    use SoftDeletes;

     protected $table = 'event_tag';

     protected $fillable = [
        'uuid',
        'event_id',
        'tag_id',
    ];

      /**
     * Indica que el pivot tiene timestamps
     */
    public $timestamps = true;
}
