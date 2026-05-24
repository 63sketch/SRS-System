<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\Payslip;
use App\Models\PersonalInfoRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ESSController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $employee = $user->employee;
        $announcements = Announcement::where('audience_type', 'all')
            ->orWhere(fn($q) => $q->where('audience_type', 'department')->where('department_id', $employee->department_id))
            ->latest()
            ->take(5)
            ->get();

        return view('ess.dashboard', compact('employee', 'announcements'));
    }

    public function myDocuments()
    {
        $documents = Auth::user()->employee->documents;
        return view('ess.documents', compact('documents'));
    }

    public function myPayslips()
    {
        $payslips = Payslip::where('employee_id', Auth::user()->employee_id)->latest()->get();
        return view('ess.payslips', compact('payslips'));
    }

    public function requestInfoUpdate(Request $request)
    {
        $validated = $request->validate([
            'field_name' => 'required|string',
            'requested_value' => 'required|string',
        ]);

        $employee = Auth::user()->employee;

        PersonalInfoRequest::create([
            'employee_id' => $employee->id,
            'field_name' => $validated['field_name'],
            'current_value' => $employee->{$validated['field_name']},
            'requested_value' => $validated['requested_value'],
            'requested_by' => Auth::id(),
        ]);

        return back()->with('success', 'Update request submitted.');
    }
}
