<?php

namespace App\Http\Controllers;

use App\Models\PerformanceCycle;
use App\Models\PerformanceGoal;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    public function index()
    {
        $cycles = PerformanceCycle::latest()->get();
        return view('performance.index', compact('cycles'));
    }

    public function goals()
    {
        $goals = PerformanceGoal::where('employee_id', Auth::user()->employee_id)->get();
        return view('performance.goals', compact('goals'));
    }

    public function storeGoal(Request $request)
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:performance_cycles,id',
            'title' => 'required|string',
            'weight' => 'required|numeric|min:1|max:100',
        ]);

        PerformanceGoal::create($validated + ['employee_id' => Auth::user()->employee_id]);

        return back()->with('success', 'Goal added.');
    }
}
