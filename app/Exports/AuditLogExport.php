<?php

namespace App\Exports;

use App\Models\AuditLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AuditLogExport implements FromCollection, WithHeadings, WithStyles
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        return $this->logs->map(function ($log) {
            return [
                'id' => $log->id,
                'user' => $log->user?->name ?? 'System',
                'action' => ucfirst($log->action),
                'module' => $log->entity_type,
                'entity_id' => $log->entity_id,
                'ip_address' => $log->ip_address,
                'created_at' => $log->created_at?->format('d-m-Y H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Action',
            'Module',
            'Entity ID',
            'IP Address',
            'Date/Time',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2C3E50']], 'font' => ['color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
