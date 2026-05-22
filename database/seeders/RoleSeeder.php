<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'description' => 'Full access, including user/role management and system settings'],
            ['name' => 'HR Admin', 'description' => 'Full HR access (create/edit employees, manage benefits, approve leave, view reports)'],
            ['name' => 'HR Officer', 'description' => 'Operational HR tasks (create employees, upload docs, draft letters), limited settings'],
            ['name' => 'Department Manager', 'description' => 'View team data, approve leave for direct reports, view team summaries'],
            ['name' => 'Employee', 'description' => 'Self-service portal access'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
