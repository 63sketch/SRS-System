<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::latest()->get();
        return view('training.index', compact('trainings'));
    }

    public function myTrainings()
    {
        $assignments = TrainingAssignment::where('employee_id', Auth::user()->employee_id)->with('training')->get();
        return view('training.my-trainings', compact('assignments'));
    }
}
