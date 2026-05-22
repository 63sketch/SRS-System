<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employee::all(['employee_code', 'first_name', 'last_name', 'gender', 'status', 'hire_date']);
    }

    public function headings(): array
    {
        return ['Code', 'First Name', 'Last Name', 'Gender', 'Status', 'Hire Date'];
    }
}
