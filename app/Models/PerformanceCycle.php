<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerformanceCycle extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'type', 'status'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function goals(): HasMany
    {
        return $this->hasMany(PerformanceGoal::class, 'cycle_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PerformanceReview::class, 'cycle_id');
    }
}
