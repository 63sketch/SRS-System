<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HeadcountExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employee::select('departments.name as department_name', DB::raw('count(*) as count'))
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->groupBy('departments.name')
            ->get();
    }

    public function headings(): array
    {
        return ['Department', 'Employee Count'];
    }
}
