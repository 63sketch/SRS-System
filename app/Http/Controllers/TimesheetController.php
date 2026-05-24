<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\TimesheetEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller
{
    public function index()
    {
        $timesheets = Timesheet::where('employee_id', Auth::user()->employee_id)
            ->latest()
            ->paginate(10);
        return view('timesheets.index', compact('timesheets'));
    }

    public function create()
    {
        return view('timesheets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'week_start_date' => 'required|date',
            'entries' => 'required|array|min:1',
            'entries.*.work_date' => 'required|date',
            'entries.*.hours_regular' => 'required|numeric|min:0',
            'entries.*.hours_overtime' => 'nullable|numeric|min:0',
        ]);

        $timesheet = Timesheet::create([
            'employee_id' => Auth::user()->employee_id,
            'week_start_date' => $validated['week_start_date'],
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        foreach ($validated['entries'] as $entry) {
            $timesheet->entries()->create($entry);
        }

        return redirect()->route('timesheets.index')->with('success', 'Timesheet submitted.');
    }

    public function approvals()
    {
        // For managers to see team timesheets
        $team_ids = Auth::user()->employee->directReports->pluck('id');
        $timesheets = Timesheet::whereIn('employee_id', $team_ids)
            ->where('status', 'submitted')
            ->with('employee')
            ->get();

        return view('timesheets.approvals', compact('timesheets'));
    }

    public function approve(Request $request, Timesheet $timesheet)
    {
        $timesheet->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Timesheet approved.');
    }
}
