<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code', 50)->unique();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('date_of_birth')->nullable();
            $table->string('nationality', 100)->nullable();
            $table->json('phones')->nullable();
            $table->json('emails')->nullable();
            $table->json('address')->nullable();
            $table->json('emergency_contact')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'onboarding', 'suspended', 'resigned', 'terminated'])->default('active');
            $table->date('hire_date')->nullable();
            $table->enum('contract_type', ['permanent', 'fixed-term', 'consultant', 'intern'])->nullable();
            $table->date('probation_start')->nullable();
            $table->date('probation_end')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supervisor_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $table->text('basic_salary')->nullable(); // Changed to text for encryption
            $table->text('bank_details')->nullable(); // Changed to text for encryption
            $table->text('tin')->nullable(); // Changed to text for encryption
            $table->text('pension_number')->nullable(); // Changed to text for encryption
            $table->foreignId('work_schedule_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Circular FK for departments head_employee_id
        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('head_employee_id')->references('id')->on('employees')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['head_employee_id']);
        });
        Schema::dropIfExists('employees');
    }
};
