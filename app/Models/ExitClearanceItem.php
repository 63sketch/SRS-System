<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExitClearanceItem extends Model
{
    protected $fillable = [
        'exit_record_id', 'checklist_item_title', 'department_id',
        'status', 'completed_by', 'completed_at', 'due_date', 'notes'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'due_date' => 'date',
    ];

    public function exitRecord(): BelongsTo
    {
        return $this->belongsTo(ExitRecord::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function completer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}
