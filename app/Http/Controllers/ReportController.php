<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
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
}
