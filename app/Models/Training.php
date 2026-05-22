<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    protected $fillable = [
        'title', 'type', 'description', 'provider', 'duration_hours',
        'cost', 'attachment_path', 'status', 'start_date', 'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function assignments(): HasMany
    {
        return $this->hasMany(TrainingAssignment::class);
    }
}
