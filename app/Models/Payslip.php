<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    protected $fillable = [
        'payroll_run_id', 'employee_id', 'period_month', 'pdf_path',
        'gross_salary', 'total_deductions', 'net_salary', 'status',
        'generated_by', 'generated_at', 'downloaded_by', 'downloaded_at'
    ];

    protected $casts = [
        'period_month' => 'date',
        'generated_at' => 'datetime',
        'downloaded_at' => 'datetime',
    ];

    public function payrollRun(): BelongsTo
    {
        return $this->belongsTo(PayrollRun::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function generator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function downloader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'downloaded_by');
    }
}
