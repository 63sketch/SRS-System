<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Exports\LeaveExport;
use App\Exports\BenefitExport;
use App\Exports\DocumentExpiryExport;
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
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function exportEmployeesPdf()
    {
        $employees = Employee::all();
        $pdf = Pdf::loadView('reports.pdf.employees', compact('employees'));
        return $pdf->download('employees.pdf');
    }

    public function exportLeaveExcel()
    {
        return Excel::download(new LeaveExport, 'leave_summary.xlsx');
    }

    public function exportBenefitsExcel()
    {
        return Excel::download(new BenefitExport, 'benefits_summary.xlsx');
    }

    public function exportDocumentExpiryExcel()
    {
        return Excel::download(new DocumentExpiryExport, 'document_expiry.xlsx');
    }
}
