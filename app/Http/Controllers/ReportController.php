<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Models\AuditLog;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Employee;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function exportEmployeesExcel()
    {
        $this->logExport('Employee List', 'Excel');
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function exportEmployeesPdf()
    {
        $employees = Employee::with(['department', 'position'])->get();
        $this->logExport('Employee List', 'PDF');
        $pdf = Pdf::loadView('reports.pdf.employees', compact('employees'));
        return $pdf->download('employees.pdf');
    }

    protected function logExport($reportName, $format)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'exported',
            'action_type' => 'export',
            'entity_type' => 'Report',
            'entity_id' => 0,
            'after_json' => json_encode(['report' => $reportName, 'format' => $format]),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
