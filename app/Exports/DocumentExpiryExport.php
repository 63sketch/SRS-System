<?php

namespace App\Exports;

use App\Models\EmployeeDocument;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentExpiryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EmployeeDocument::with('employee')
            ->whereNotNull('expiry_date')
            ->get()
            ->map(fn($doc) => [
                'Employee' => $doc->employee->first_name . ' ' . $doc->employee->last_name,
                'Document' => $doc->title,
                'Category' => $doc->category,
                'Expiry Date' => $doc->expiry_date->format('Y-m-d'),
                'Status' => $doc->verification_status,
            ]);
    }

    public function headings(): array
    {
        return ['Employee', 'Document', 'Category', 'Expiry Date', 'Status'];
    }
}
