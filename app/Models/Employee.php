<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_code', 'first_name', 'middle_name', 'last_name',
        'gender', 'date_of_birth', 'nationality', 'phones', 'emails',
        'address', 'emergency_contact', 'photo', 'status', 'hire_date',
        'contract_type', 'probation_start', 'probation_end', 'department_id',
        'position_id', 'supervisor_id', 'location_id', 'basic_salary',
        'bank_details', 'tin', 'pension_number', 'work_schedule_id'
    ];

    protected $casts = [
        'phones' => 'json',
        'emails' => 'json',
        'address' => 'json',
        'emergency_contact' => 'json',
        'bank_details' => 'encrypted:json',
        'basic_salary' => 'encrypted',
        'tin' => 'encrypted',
        'pension_number' => 'encrypted',
        'date_of_birth' => 'date',
        'hire_date' => 'date',
        'probation_start' => 'date',
        'probation_end' => 'date',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
