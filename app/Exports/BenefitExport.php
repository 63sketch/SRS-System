<?php

namespace App\Exports;

use App\Models\EmployeeBenefit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BenefitExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EmployeeBenefit::with(['employee', 'benefit'])
            ->get()
            ->map(fn($eb) => [
                'Employee' => $eb->employee->first_name . ' ' . $eb->employee->last_name,
                'Benefit' => $eb->benefit->name,
                'Category' => $eb->benefit->category,
                'Value' => $eb->value,
                'Start Date' => $eb->start_date->format('Y-m-d'),
                'Status' => $eb->status,
            ]);
    }

    public function headings(): array
    {
        return ['Employee', 'Benefit', 'Category', 'Value', 'Start Date', 'Status'];
    }
}
