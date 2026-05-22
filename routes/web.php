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
});

require __DIR__.'/auth.php';
