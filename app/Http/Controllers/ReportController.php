<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Exports\LeaveExport;
use App\Exports\BenefitExport;
use App\Exports\DocumentExpiryExport;
use App\Exports\HeadcountExport;
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

    public function exportLeaveExcel()
    {
        $this->logExport('Leave Summary', 'Excel');
        return Excel::download(new LeaveExport, 'leave_summary.xlsx');
    }

    public function exportBenefitsExcel()
    {
        $this->logExport('Benefits Summary', 'Excel');
        return Excel::download(new BenefitExport, 'benefits_summary.xlsx');
    }

    public function exportDocumentExpiryExcel()
    {
        $this->logExport('Document Expiry', 'Excel');
        return Excel::download(new DocumentExpiryExport, 'document_expiry.xlsx');
    }

    public function exportHeadcountExcel()
    {
        $this->logExport('Headcount Report', 'Excel');
        return Excel::download(new HeadcountExport, 'headcount_report.xlsx');
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
