<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryEvent extends Pivot
{
    use SoftDeletes;

    protected $table = 'category_event';

    protected $fillable = [
        'uuid',
        'category_id',
        'event_id',
    ];
}
