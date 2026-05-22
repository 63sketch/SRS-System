<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->enum('type', ['internal', 'external', 'online']);
            $table->text('description')->nullable();
            $table->string('provider', 255)->nullable();
            $table->decimal('duration_hours', 6, 2)->nullable();
            $table->decimal('cost', 12, 2)->nullable();
            $table->string('attachment_path', 500)->nullable();
            $table->enum('status', ['planned', 'open', 'completed', 'cancelled'])->default('planned');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
