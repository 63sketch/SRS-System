<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\LogsActivity;

class Position extends Model
    use LogsActivity;
{
    use SoftDeletes, LogsActivity;

    protected $fillable = ['title', 'department_id', 'grade', 'description'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
