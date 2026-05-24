<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\PayrollRun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $headcountByDept = Employee::select('departments.name', DB::raw('count(*) as total'))
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->groupBy('departments.name')
            ->get();

        $payrollHistory = PayrollRun::where('status', 'locked')
            ->latest()
            ->take(6)
            ->get();

        return view('analytics.index', compact('headcountByDept', 'payrollHistory'));
    }
}
