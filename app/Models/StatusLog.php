<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatusLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'entity_type', 'entity_id', 'from_status', 'to_status',
        'changed_by', 'changed_at', 'metadata', 'correlation_id'
    ];

    protected $casts = [
        'changed_at' => 'datetime',
        'metadata' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
