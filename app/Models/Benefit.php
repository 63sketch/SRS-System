<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $fillable = ['name', 'category', 'description', 'eligibility_rule', 'default_value'];

    protected $casts = [
        'eligibility_rule' => 'json',
    ];
}
