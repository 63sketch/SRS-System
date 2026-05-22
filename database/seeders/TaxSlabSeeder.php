<?php

namespace Database\Seeders;

use App\Models\TaxSlab;
use Illuminate\Database\Seeder;

class TaxSlabSeeder extends Seeder
{
    public function run(): void
    {
        $slabs = [
            ['min_income' => 0, 'max_income' => 600, 'rate' => 0, 'fixed_deduction' => 0, 'year' => 2026],
            ['min_income' => 601, 'max_income' => 1650, 'rate' => 10, 'fixed_deduction' => 60, 'year' => 2026],
            ['min_income' => 1651, 'max_income' => 3200, 'rate' => 15, 'fixed_deduction' => 142.5, 'year' => 2026],
            ['min_income' => 3201, 'max_income' => 5250, 'rate' => 20, 'fixed_deduction' => 302.5, 'year' => 2026],
            ['min_income' => 5251, 'max_income' => 7800, 'rate' => 25, 'fixed_deduction' => 565, 'year' => 2026],
            ['min_income' => 7801, 'max_income' => 10900, 'rate' => 30, 'fixed_deduction' => 955, 'year' => 2026],
            ['min_income' => 10901, 'max_income' => null, 'rate' => 35, 'fixed_deduction' => 1500, 'year' => 2026],
        ];

        foreach ($slabs as $slab) {
            TaxSlab::create($slab);
        }
    }
}
