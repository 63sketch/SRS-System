<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exit_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->restrictOnDelete();
            $table->date('resignation_date')->nullable();
            $table->date('last_working_date');
            $table->enum('exit_type', ['resignation', 'termination', 'retirement', 'end_of_contract', 'other']);
            $table->text('reason')->nullable();
            $table->integer('notice_period_days')->nullable();
            $table->enum('status', ['initiated', 'in_progress', 'cleared', 'completed'])->default('initiated');
            $table->foreignId('initiated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('version')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exit_records');
    }
};
