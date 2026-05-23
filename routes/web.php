<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HR Routes
    Route::middleware('role:HR Admin')->group(function () {
        Route::resource('employees', EmployeeController::class);
    });

    // Leave Routes
    Route::resource('leave', LeaveRequestController::class);
    Route::post('leave/{leaveRequest}/approve', [LeaveRequestController::class, 'approve'])->name('leave.approve');

    // Settings Routes
    Route::middleware('role:Super Admin')->group(function () {
        Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');

        // Audit Logs
        Route::get('audit-logs', [\App\Http\Controllers\AuditLogController::class, 'index'])->name('audit-logs.index');
        Route::get('audit-logs/{auditLog}', [\App\Http\Controllers\AuditLogController::class, 'show'])->name('audit-logs.show');

        // Reports
        Route::get('reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/employees/excel', [\App\Http\Controllers\ReportController::class, 'exportEmployeesExcel'])->name('reports.employees.excel');
        Route::get('reports/employees/pdf', [\App\Http\Controllers\ReportController::class, 'exportEmployeesPdf'])->name('reports.employees.pdf');
        Route::get('reports/leave/excel', [\App\Http\Controllers\ReportController::class, 'exportLeaveExcel'])->name('reports.leave.excel');
        Route::get('reports/benefits/excel', [\App\Http\Controllers\ReportController::class, 'exportBenefitsExcel'])->name('reports.benefits.excel');
        Route::get('reports/expiry/excel', [\App\Http\Controllers\ReportController::class, 'exportDocumentExpiryExcel'])->name('reports.expiry.excel');
        Route::get('reports/headcount/excel', [\App\Http\Controllers\ReportController::class, 'exportHeadcountExcel'])->name('reports.headcount.excel');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('force-password-reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'show'])
        ->name('password.force-reset');
    Route::post('force-password-reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'store'])
        ->name('password.force-reset.update');
});

require __DIR__.'/auth.php';
