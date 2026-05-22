<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cycle_id')->constrained('performance_cycles')->restrictOnDelete();
            $table->foreignId('employee_id')->constrained()->restrictOnDelete();
            $table->json('self_rating')->nullable();
            $table->json('manager_rating')->nullable();
            $table->enum('overall_rating', ['outstanding', 'exceeds', 'meets', 'needs_improvement', 'unsatisfactory'])->nullable();
            $table->text('manager_comments')->nullable();
            $table->text('hr_comments')->nullable();
            $table->enum('status', ['self_assessment', 'manager_review', 'hr_calibration', 'published'])->default('self_assessment');
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('version')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_reviews');
    }
};
