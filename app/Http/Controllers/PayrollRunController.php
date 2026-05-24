<?php

namespace App\Http\Controllers;

use App\Models\PayrollRun;
use App\Models\Employee;
use App\Services\PayrollService;
use App\Support\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollRunController extends Controller
{
    protected $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    public function index()
    {
        $runs = PayrollRun::latest()->paginate(12);
        return view('payroll.index', compact('runs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period_month' => 'required|date',
        ]);

        $periodMonth = \Carbon\Carbon::parse($validated['period_month']);

        $run = PayrollRun::create([
            'period_month' => $periodMonth,
            'status' => 'draft',
            'processed_by' => Auth::id(),
        ]);

        $employees = Employee::where('status', 'active')->get();

        foreach ($employees as $employee) {
            $salaryData = $this->payrollService->calculateNetSalary($employee->basic_salary, $employee, $periodMonth);

            $run->items()->create([
                'employee_id' => $employee->id,
                'basic_salary' => $employee->basic_salary,
                'gross_salary' => $salaryData['gross'],
                'taxable_income' => $salaryData['taxable_income'],
                'income_tax' => $salaryData['income_tax'],
                'pension_employee' => $salaryData['pension_employee'],
                'pension_employer' => Money::roundNet($employee->basic_salary * 0.11),
                'net_salary' => $salaryData['net_salary'],
            ]);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll processed.');
    }

    public function show(PayrollRun $payrollRun)
    {
        return view('payroll.show', compact('payrollRun'));
    }

    public function approve(PayrollRun $payrollRun)
    {
        $payrollRun->update(['status' => 'approved', 'approved_by' => Auth::id()]);
        return back()->with('success', 'Payroll approved.');
    }
}
