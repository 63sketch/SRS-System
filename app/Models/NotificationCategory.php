<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationCategory extends Model
{
    protected $fillable = ['key_name', 'name', 'description', 'is_system_wide_enabled'];

    protected $casts = [
        'is_system_wide_enabled' => 'boolean',
    ];
}
