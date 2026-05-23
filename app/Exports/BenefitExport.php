<?php

namespace App\Exports;

use App\Models\EmployeeBenefit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BenefitExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return EmployeeBenefit::with(['employee', 'benefit'])
            ->get()
            ->map(function ($eb) {
                return [
                    'employee_id' => $eb->employee?->employee_code,
                    'employee_name' => $eb->employee?->first_name . ' ' . $eb->employee?->last_name,
                    'benefit_name' => $eb->benefit?->name,
                    'benefit_type' => $eb->benefit?->category,
                    'amount' => $eb->value,
                    'status' => ucfirst($eb->status),
                    'effective_date' => $eb->start_date?->format('d-m-Y'),
                    'end_date' => $eb->end_date?->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Benefit Name',
            'Benefit Type',
            'Amount',
            'Status',
            'Effective Date',
            'End Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '9B59B6']], 'font' => ['color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
