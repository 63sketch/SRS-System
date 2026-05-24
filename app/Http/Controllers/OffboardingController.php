<?php

namespace App\Http\Controllers;

use App\Models\ExitRecord;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffboardingController extends Controller
{
    public function index()
    {
        $exits = ExitRecord::with('employee')->latest()->get();
        return view('offboarding.index', compact('exits'));
    }

    public function initiate(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'exit_type' => 'required|in:resignation,termination,retirement,end_of_contract,other',
            'last_working_date' => 'required|date',
        ]);

        ExitRecord::create($validated + [
            'status' => 'initiated',
            'initiated_by' => Auth::id(),
        ]);

        return redirect()->route('offboarding.index')->with('success', 'Offboarding initiated.');
    }
}
