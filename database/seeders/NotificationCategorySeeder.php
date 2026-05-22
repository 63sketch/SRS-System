<?php

namespace Database\Seeders;

use App\Models\NotificationCategory;
use Illuminate\Database\Seeder;

class NotificationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['key_name' => 'leave.submitted', 'name' => 'Leave Request Submitted', 'description' => 'When employee submits a leave request'],
            ['key_name' => 'leave.approved', 'name' => 'Leave Request Approved', 'description' => 'When leave request is approved'],
            ['key_name' => 'leave.rejected', 'name' => 'Leave Request Rejected', 'description' => 'When leave request is rejected'],
            ['key_name' => 'timesheet.submitted', 'name' => 'Timesheet Submitted', 'description' => 'When employee submits timesheet'],
            ['key_name' => 'timesheet.approved', 'name' => 'Timesheet Approved', 'description' => 'When timesheet is approved'],
            ['key_name' => 'payroll.payslip', 'name' => 'Payslip Available', 'description' => 'When new payslip is generated'],
            ['key_name' => 'document.expiry', 'name' => 'Document Expiring', 'description' => 'When employee document is nearing expiry'],
            ['key_name' => 'announcement.new', 'name' => 'New Announcement', 'description' => 'When new announcement is published'],
            ['key_name' => 'performance.rating', 'name' => 'Performance Rating Published', 'description' => 'When performance rating is published'],
        ];

        foreach ($categories as $category) {
            NotificationCategory::firstOrCreate(['key_name' => $category['key_name']], $category);
        }
    }
}
