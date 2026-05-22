<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollRun extends Model
{
    protected $fillable = [
        'period_month', 'run_type', 'original_run_id', 'correction_reason',
        'status', 'total_gross', 'total_net', 'processed_by', 'approved_by',
        'input_snapshot', 'version'
    ];

    protected $casts = [
        'period_month' => 'date',
        'input_snapshot' => 'json',
    ];

    public function originalRun(): BelongsTo
    {
        return $this->belongsTo(PayrollRun::class, 'original_run_id');
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PayrollItem::class);
    }
}
