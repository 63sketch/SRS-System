<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    protected $fillable = [
        'title', 'body', 'author_id', 'audience_type', 'department_id',
        'role_id', 'publish_date', 'expiry_date', 'is_pinned',
        'requires_acknowledgment', 'attachment_path'
    ];

    protected $casts = [
        'publish_date' => 'date',
        'expiry_date' => 'date',
        'is_pinned' => 'boolean',
        'requires_acknowledgment' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function acknowledgments(): HasMany
    {
        return $this->hasMany(AnnouncementAcknowledgment::class);
    }
}
