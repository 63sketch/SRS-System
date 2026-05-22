<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = [
        'name', 'default_allowance', 'requires_attachment',
        'approval_flow', 'carry_over_policy', 'carry_over_limit'
    ];
}
