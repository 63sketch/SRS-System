<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxSlab extends Model
{
    protected $fillable = ['min_income', 'max_income', 'rate', 'fixed_deduction', 'year'];
}
