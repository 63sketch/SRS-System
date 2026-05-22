<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExitInterview extends Model
{
    protected $fillable = [
        'exit_record_id', 'interview_date', 'interviewer_id',
        'reason_for_leaving', 'would_rehire', 'overall_feedback', 'suggestions'
    ];

    protected $casts = [
        'interview_date' => 'date',
    ];

    public function exitRecord(): BelongsTo
    {
        return $this->belongsTo(ExitRecord::class);
    }

    public function interviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }
}
