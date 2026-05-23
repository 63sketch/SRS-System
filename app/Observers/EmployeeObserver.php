<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\EmployeeHistory;
use Illuminate\Support\Facades\Auth;

class EmployeeObserver
{
    public function updated(Employee $employee): void
    {
        if ($employee->isDirty('basic_salary')) {
            EmployeeHistory::create([
                'employee_id' => $employee->id,
                'change_type' => 'salary_change',
                'old_value' => $employee->getOriginal('basic_salary'),
                'new_value' => $employee->basic_salary,
                'effective_date' => now(),
                'approved_by' => Auth::id(),
            ]);
        }

        if ($employee->isDirty('status')) {
            EmployeeHistory::create([
                'employee_id' => $employee->id,
                'change_type' => 'status_change',
                'old_value' => $employee->getOriginal('status'),
                'new_value' => $employee->status,
                'effective_date' => now(),
                'approved_by' => Auth::id(),
            ]);
        }
    }
}
