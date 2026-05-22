<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'company_name' => 'Birrama Inc.',
            'company_logo_path' => null,
            'employee_id_format' => 'EMP-{YYYY}-{0000}',
            'employee_id_counter' => '1000',
            'notification_email_enabled' => '1',
            'notification_inapp_enabled' => '1',
            'data_retention_days' => '365',
            'timezone' => 'Africa/Addis_Ababa',
            'date_format' => 'Y-m-d',
            'currency' => 'ETB',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
