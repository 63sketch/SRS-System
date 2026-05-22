<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimesheetEntry extends Model
{
    protected $fillable = ['timesheet_id', 'work_date', 'hours_regular', 'hours_overtime', 'project_task', 'notes'];

    protected $casts = [
        'work_date' => 'date',
    ];

    public function timesheet(): BelongsTo
    {
        return $this->belongsTo(Timesheet::class);
    }
}
