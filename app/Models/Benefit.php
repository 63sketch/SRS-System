<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
use App\Traits\LogsActivity;

class Benefit extends Model
    use LogsActivity;
{
    use LogsActivity;
    protected $fillable = ['name', 'category', 'description', 'eligibility_rule', 'default_value'];

    protected $casts = [
        'eligibility_rule' => 'json',
    ];
}
