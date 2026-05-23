<?php

namespace App\Exports;

use App\Models\LeaveRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeaveExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return LeaveRequest::with(['employee', 'leaveType'])
            ->get()
            ->map(fn($request) => [
                'Employee' => $request->employee->first_name . ' ' . $request->employee->last_name,
                'Type' => $request->leaveType->name,
                'Start Date' => $request->start_date->format('Y-m-d'),
                'End Date' => $request->end_date->format('Y-m-d'),
                'Days' => $request->days,
                'Status' => $request->status,
            ]);
    }

    public function headings(): array
    {
        return ['Employee', 'Leave Type', 'Start Date', 'End Date', 'Days', 'Status'];
    }
}
