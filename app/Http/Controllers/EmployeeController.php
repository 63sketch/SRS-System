<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position', 'location'])->paginate(15);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $locations = Location::all();
        $supervisors = Employee::all();
        return view('employees.create', compact('departments', 'positions', 'locations', 'supervisors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_code' => 'required|string|unique:employees,employee_code',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
            'phones' => 'nullable|array',
            'emails' => 'nullable|array',
            'address' => 'nullable|array',
            'emergency_contact' => 'nullable|array',
            'status' => 'required|in:active,onboarding,suspended,resigned,terminated',
            'hire_date' => 'nullable|date',
            'contract_type' => 'nullable|in:permanent,fixed-term,consultant,intern',
            'probation_start' => 'nullable|date',
            'probation_end' => 'nullable|date',
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'supervisor_id' => 'nullable|exists:employees,id',
            'location_id' => 'nullable|exists:locations,id',
            'basic_salary' => 'nullable|numeric',
            'bank_details' => 'nullable|array',
            'tin' => 'nullable|string',
            'pension_number' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        $locations = Location::all();
        $supervisors = Employee::where('id', '!=', $employee->id)->get();
        return view('employees.edit', compact('employee', 'departments', 'positions', 'locations', 'supervisors'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_code' => 'required|string|unique:employees,employee_code,' . $employee->id,
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
            'status' => 'required|in:active,onboarding,suspended,resigned,terminated',
            'hire_date' => 'nullable|date',
            'contract_type' => 'nullable|in:permanent,fixed-term,consultant,intern',
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'supervisor_id' => 'nullable|exists:employees,id',
            'location_id' => 'nullable|exists:locations,id',
            'basic_salary' => 'nullable|numeric',
            'tin' => 'nullable|string',
            'pension_number' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee archived successfully.');
    }
}
