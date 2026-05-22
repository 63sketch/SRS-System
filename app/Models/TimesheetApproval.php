<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimesheetApproval extends Model
{
    protected $fillable = ['timesheet_id', 'approver_user_id', 'action', 'comment', 'action_at'];

    protected $casts = [
        'action_at' => 'datetime',
    ];

    public function timesheet(): BelongsTo
    {
        return $this->belongsTo(Timesheet::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_user_id');
    }
}
