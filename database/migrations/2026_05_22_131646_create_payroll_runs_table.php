<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_runs', function (Blueprint $table) {
            $table->id();
            $table->date('period_month');
            $table->enum('run_type', ['regular', 'supplementary'])->default('regular');
            $table->foreignId('original_run_id')->nullable()->constrained('payroll_runs')->nullOnDelete();
            $table->text('correction_reason')->nullable();
            $table->enum('status', ['draft', 'review', 'approved', 'locked'])->default('draft');
            $table->decimal('total_gross', 15, 2)->nullable();
            $table->decimal('total_net', 15, 2)->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->json('input_snapshot')->nullable();
            $table->unsignedInteger('version')->default(0);
            $table->timestamps();
            $table->unique(['period_month', 'run_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_runs');
    }
};
