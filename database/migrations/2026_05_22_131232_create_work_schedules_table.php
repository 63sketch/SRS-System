<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->json('working_days');
            $table->decimal('standard_hours_per_day', 5, 2)->default(8.00);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // Add foreign key to employees
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('work_schedule_id')->references('id')->on('work_schedules')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['work_schedule_id']);
        });
        Schema::dropIfExists('work_schedules');
    }
};
