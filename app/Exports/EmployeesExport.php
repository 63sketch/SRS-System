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
                    'employee_id' => $employee->employee_code,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'email' => $employee->email,
                    'phone' => is_array($employee->phones) ? implode(', ', $employee->phones) : $employee->phones,
                    'department' => $employee->department?->name ?? 'N/A',
                    'position' => $employee->position?->title ?? 'N/A',
                    'manager' => $employee->supervisor?->first_name . ' ' . $employee->supervisor?->last_name ?? 'N/A',
                    'employment_status' => ucfirst($employee->status),
                    'join_date' => $employee->hire_date?->format('d-m-Y'),
                    'created_at' => $employee->created_at?->format('d-m-Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Department',
            'Position',
            'Manager',
            'Status',
            'Join Date',
            'Created Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '366092']], 'font' => ['color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
