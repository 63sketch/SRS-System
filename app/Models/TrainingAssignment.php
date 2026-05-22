<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingAssignment extends Model
{
    protected $fillable = [
        'training_id', 'employee_id', 'assigned_by', 'assigned_at',
        'completed_date', 'score', 'certificate_path', 'status'
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'completed_date' => 'date',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
