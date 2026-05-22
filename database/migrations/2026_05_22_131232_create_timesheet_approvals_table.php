<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timesheet_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timesheet_id')->constrained()->restrictOnDelete();
            $table->foreignId('approver_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('action', ['approved', 'returned', 'reviewed']);
            $table->text('comment')->nullable();
            $table->timestamp('action_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timesheet_approvals');
    }
};
