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

    // Timesheet Routes
    Route::resource('timesheets', TimesheetController::class);
    Route::get('approvals/timesheets', [\App\Http\Controllers\TimesheetController::class, 'approvals'])->name('timesheets.approvals');
    Route::post('timesheets/{timesheet}/approve', [\App\Http\Controllers\TimesheetController::class, 'approve'])->name('timesheets.approve');

    // ESS Routes
    Route::prefix('ess')->name('ess.')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\ESSController::class, 'dashboard'])->name('dashboard');
        Route::get('my-documents', [\App\Http\Controllers\ESSController::class, 'myDocuments'])->name('documents');
        Route::get('my-payslips', [\App\Http\Controllers\ESSController::class, 'myPayslips'])->name('payslips');
        Route::post('request-update', [\App\Http\Controllers\ESSController::class, 'requestInfoUpdate'])->name('request-update');
    });

    // Payroll Routes
    Route::middleware('role:HR Admin')->group(function () {
        Route::resource('payroll', PayrollRunController::class);
        Route::post('payroll/{payrollRun}/approve', [PayrollRunController::class, 'approve'])->name('payroll.approve');
    });

    // Performance Routes
    Route::get('performance/goals', [PerformanceController::class, 'goals'])->name('performance.goals');
    Route::post('performance/goals', [PerformanceController::class, 'storeGoal'])->name('performance.goals.store');
    Route::resource('performance/cycles', PerformanceController::class);

    // Recruitment Routes
    Route::get('recruitment', [RecruitmentController::class, 'index'])->name('recruitment.index');
    Route::get('recruitment/{job}/applicants', [RecruitmentController::class, 'applicants'])->name('recruitment.applicants');
    Route::post('recruitment', [RecruitmentController::class, 'storeJob'])->name('recruitment.store');

    // Training Routes
    Route::get('training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('my-training', [TrainingController::class, 'myTrainings'])->name('training.my');

    // Offboarding Routes
    Route::resource('offboarding', OffboardingController::class);

    // Notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Analytics
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

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
    Route::get('force-password-reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])
        ->name('password.force-reset');
    Route::post('force-password-reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'forceReset'])
        ->name('password.force-reset.store');
});

require __DIR__.'/auth.php';
