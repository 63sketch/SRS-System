<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\TaxSlab;
use App\Support\Money;
use App\Models\Timesheet;

class PayrollService
{
    public function calculateNetSalary(float $basicSalary, Employee $employee, $periodMonth)
    {
        // 1. Calculate Overtime from approved timesheets in that month
        $overtimeHours = $employee->timesheets()
            ->where('status', 'approved')
            ->whereMonth('week_start_date', $periodMonth->month)
            ->whereYear('week_start_date', $periodMonth->year)
            ->with('entries')
            ->get()
            ->flatMap->entries
            ->sum('hours_overtime');

        $hourlyRate = $basicSalary / 160; // Assuming 160 working hours month
        $overtimePay = Money::roundNet($overtimeHours * $hourlyRate * 1.5); // 1.5x rate

        // 2. Add Benefits
        $benefitsPay = $employee->benefits()
            ->where('status', 'active')
            ->sum('value');

        $grossSalary = $basicSalary + $overtimePay + $benefitsPay;

        // 3. Deductions (Ethiopian Law)
        $pensionEmployee = Money::roundNet($basicSalary * 0.07);
        $taxableIncome = $grossSalary - $pensionEmployee;

        $incomeTax = $this->calculateTax($taxableIncome);
        $netSalary = $taxableIncome - $incomeTax;

        return [
            'basic' => $basicSalary,
            'overtime' => $overtimePay,
            'benefits' => $benefitsPay,
            'gross' => $grossSalary,
            'taxable_income' => $taxableIncome,
            'income_tax' => $incomeTax,
            'pension_employee' => $pensionEmployee,
            'net_salary' => $netSalary,
        ];
    }

    protected function calculateTax(float $taxableIncome)
    {
        $slab = TaxSlab::where('min_income', '<=', $taxableIncome)
            ->where(fn($q) => $q->whereNull('max_income')->orWhere('max_income', '>=', $taxableIncome))
            ->first();

        if (!$slab) return 0;

        $tax = ($taxableIncome * ($slab->rate / 100)) - $slab->fixed_deduction;
        return Money::roundTax(max(0, $tax));
    }
}
