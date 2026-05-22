<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    protected $fillable = ['name', 'working_days', 'standard_hours_per_day', 'is_default'];

    protected $casts = [
        'working_days' => 'json',
    ];
}
