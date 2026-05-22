<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->constrained()->restrictOnDelete();
            $table->string('full_name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('cv_path', 500)->nullable();
            $table->string('source', 100)->nullable();
            $table->enum('stage', [
                'cv_review', 'shortlisted', 'interview_scheduled', 'interview_done',
                'offer_extended', 'offer_accepted', 'hired', 'rejected'
            ])->default('cv_review');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
