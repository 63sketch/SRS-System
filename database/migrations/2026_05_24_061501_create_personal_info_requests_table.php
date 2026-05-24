<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_info_requests', function (Blueprint ) {
            ->id();
            ->foreignId('employee_id')->constrained()->restrictOnDelete();
            ->string('field_name', 100);
            ->text('current_value')->nullable();
            ->text('requested_value');
            ->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            ->foreignId('requested_by')->constrained('users')->restrictOnDelete();
            ->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            ->text('review_comment')->nullable();
            ->timestamp('reviewed_at')->nullable();
            ->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_info_requests');
    }
};
