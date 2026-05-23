<?php

namespace App\Exports;

use App\Models\EmployeeDocument;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DocumentExpiryExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return EmployeeDocument::with('employee')
            ->whereNotNull('expiry_date')
            ->get()
            ->map(function ($doc) {
                $expiryStatus = 'Active';
                if ($doc->expiry_date && $doc->expiry_date < now()) {
                    $expiryStatus = 'Expired';
                } elseif ($doc->expiry_date && $doc->expiry_date < now()->addDays(30)) {
                    $expiryStatus = 'Expiring Soon';
                }

                return [
                    'employee_id' => $doc->employee?->employee_code,
                    'employee_name' => $doc->employee?->first_name . ' ' . $doc->employee?->last_name,
                    'document_type' => $doc->category,
                    'file_name' => $doc->title,
                    'issue_date' => $doc->issue_date?->format('d-m-Y'),
                    'expiry_date' => $doc->expiry_date?->format('d-m-Y'),
                    'status' => $expiryStatus,
                    'verification_status' => ucfirst($doc->verification_status),
                    'uploaded_date' => $doc->created_at?->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Document Type',
            'File Name',
            'Issue Date',
            'Expiry Date',
            'Status',
            'Verification',
            'Uploaded Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'E67E22']], 'font' => ['color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
