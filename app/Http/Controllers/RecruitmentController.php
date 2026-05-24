<?php

namespace App\Http\Controllers;

use App\Models\JobOpening;
use App\Models\Applicant;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index()
    {
        $jobs = JobOpening::withCount('applicants')->latest()->paginate(10);
        return view('recruitment.index', compact('jobs'));
    }

    public function applicants(JobOpening $job)
    {
        $applicants = $job->applicants()->latest()->get();
        return view('recruitment.applicants', compact('job', 'applicants'));
    }

    public function storeJob(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'vacancies' => 'required|integer|min:1',
        ]);

        JobOpening::create($validated + ['status' => 'open']);

        return redirect()->route('recruitment.index')->with('success', 'Job opening created.');
    }
}
