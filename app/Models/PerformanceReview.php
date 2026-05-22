<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerformanceReview extends Model
{
    protected $fillable = [
        'cycle_id', 'employee_id', 'self_rating', 'manager_rating',
        'overall_rating', 'manager_comments', 'hr_comments', 'status',
        'published_at', 'version'
    ];

    protected $casts = [
        'self_rating' => 'json',
        'manager_rating' => 'json',
        'published_at' => 'datetime',
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(PerformanceCycle::class, 'cycle_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ReviewComment::class, 'review_id');
    }
}
