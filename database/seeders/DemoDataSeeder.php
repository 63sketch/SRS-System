<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Locations
        $hq = Location::create(['name' => 'Addis Ababa HQ', 'address' => 'Bole, Addis Ababa']);

        // 2. Departments
        $hrDept = Department::create(['name' => 'Human Resources', 'description' => 'HR and Administration']);
        $itDept = Department::create(['name' => 'Information Technology', 'description' => 'IT Support and Development']);

        // 3. Positions
        $hrManagerPos = Position::create(['title' => 'HR Manager', 'department_id' => $hrDept->id]);
        $devPos = Position::create(['title' => 'Senior Developer', 'department_id' => $itDept->id]);

        // 4. Employees
        $adminEmp = Employee::create([
            'employee_code' => 'EMP001',
            'first_name' => 'System',
            'last_name' => 'Admin',
            'gender' => 'male',
            'status' => 'active',
            'department_id' => $hrDept->id,
            'position_id' => $hrManagerPos->id,
            'location_id' => $hq->id,
            'basic_salary' => 50000,
        ]);

        $emp002 = Employee::create([
            'employee_code' => 'EMP002',
            'first_name' => 'Abebe',
            'last_name' => 'Bikila',
            'gender' => 'male',
            'status' => 'active',
            'department_id' => $itDept->id,
            'position_id' => $devPos->id,
            'location_id' => $hq->id,
            'basic_salary' => 45000,
            'supervisor_id' => $adminEmp->id,
        ]);

        // 5. Users
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $employeeRole = Role::where('name', 'Employee')->first();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@birrama.com',
            'password' => Hash::make('password'),
            'role_id' => $superAdminRole->id,
            'employee_id' => $adminEmp->id,
        ]);

        User::create([
            'name' => 'Abebe Bikila',
            'email' => 'abebe@birrama.com',
            'password' => Hash::make('password'),
            'role_id' => $employeeRole->id,
            'employee_id' => $emp002->id,
        ]);
    }
}
