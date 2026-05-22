<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Interview extends Model
{
    protected $fillable = [
        'applicant_id', 'job_opening_id', 'interview_date', 'interview_type',
        'location_or_link', 'panel_members', 'status', 'notes', 'created_by'
    ];

    protected $casts = [
        'interview_date' => 'datetime',
        'panel_members' => 'json',
    ];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function jobOpening(): BelongsTo
    {
        return $this->belongsTo(JobOpening::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(InterviewScore::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
