<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exit_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exit_record_id')->unique()->constrained('exit_records')->restrictOnDelete();
            $table->date('interview_date');
            $table->foreignId('interviewer_id')->constrained('users')->restrictOnDelete();
            $table->text('reason_for_leaving')->nullable();
            $table->enum('would_rehire', ['yes', 'no', 'maybe'])->nullable();
            $table->text('overall_feedback')->nullable();
            $table->text('suggestions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exit_interviews');
    }
};
