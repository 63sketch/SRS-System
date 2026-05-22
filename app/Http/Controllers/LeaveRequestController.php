<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $requests = LeaveRequest::with(['employee', 'leaveType'])->latest()->paginate(15);
        return view('leave.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
        ]);

        $employee = $request->user()->employee;

        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $request->file('attachment')->store('leave_attachments', 'secure');
        }

        $validated['employee_id'] = $employee->id;
        $validated['days'] = 1; // Logic to calculate working days excluding holidays
        $validated['status'] = 'submitted';

        LeaveRequest::create($validated);

        return redirect()->route('leave.index')->with('success', 'Leave request submitted.');
    }

    public function approve(Request $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'hr_approved']);

        return back()->with('success', 'Leave approved.');
    }
}
