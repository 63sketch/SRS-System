<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ExitRecord extends Model
{
    protected $fillable = [
        'employee_id', 'resignation_date', 'last_working_date',
        'exit_type', 'reason', 'notice_period_days', 'status',
        'initiated_by', 'processed_by', 'version'
    ];

    protected $casts = [
        'resignation_date' => 'date',
        'last_working_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function interview(): HasOne
    {
        return $this->hasOne(ExitInterview::class);
    }

    public function clearanceItems(): HasMany
    {
        return $this->hasMany(ExitClearanceItem::class);
    }
}
