<?php

namespace App\Exports;

use App\Models\LeaveRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeaveExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return LeaveRequest::with(['employee', 'leaveType'])
            ->get()
            ->map(function ($leave) {
                return [
                    'employee_id' => $leave->employee?->employee_code,
                    'employee_name' => $leave->employee?->first_name . ' ' . $leave->employee?->last_name,
                    'leave_type' => $leave->leaveType?->name,
                    'start_date' => $leave->start_date?->format('d-m-Y'),
                    'end_date' => $leave->end_date?->format('d-m-Y'),
                    'days' => $leave->days,
                    'status' => ucfirst($leave->status),
                    'reason' => substr($leave->reason, 0, 50),
                    'created_date' => $leave->created_at?->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Leave Type',
            'Start Date',
            'End Date',
            'Days',
            'Status',
            'Reason',
            'Created Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F39C12']], 'font' => ['color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
