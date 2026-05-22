<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->restrictOnDelete();
            $table->enum('change_type', [
                'salary_change', 'position_change', 'department_transfer',
                'contract_change', 'status_change', 'probation_completed'
            ]);
            $table->string('old_value', 255)->nullable();
            $table->string('new_value', 255);
            $table->date('effective_date');
            $table->text('reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_history');
    }
};
