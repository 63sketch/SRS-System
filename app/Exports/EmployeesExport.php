<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Employee::with(['department', 'position', 'supervisor'])
            ->get()
            ->map(function ($employee) {
                return [
                    'employee_code' => $employee->employee_code,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'email' => $employee->email,
                    'department' => $employee->department?->name ?? 'N/A',
                    'position' => $employee->position?->title ?? 'N/A',
                    'supervisor' => $employee->supervisor?->first_name . ' ' . $employee->supervisor?->last_name ?? 'N/A',
                    'status' => ucfirst($employee->status),
                    'hire_date' => $employee->hire_date?->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee Code',
            'First Name',
            'Last Name',
            'Email',
            'Department',
            'Position',
            'Supervisor',
            'Status',
            'Hire Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '366092']], 'font' => ['color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
