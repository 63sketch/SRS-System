<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timesheet_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timesheet_id')->constrained()->restrictOnDelete();
            $table->date('work_date');
            $table->decimal('hours_regular', 6, 2)->default(0);
            $table->decimal('hours_overtime', 6, 2)->default(0);
            $table->string('project_task', 255)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timesheet_entries');
    }
};
