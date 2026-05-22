<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exit_clearance_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exit_record_id')->constrained('exit_records')->restrictOnDelete();
            $table->string('checklist_item_title', 255);
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->enum('status', ['pending', 'completed', 'waived'])->default('pending');
            $table->foreignId('completed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exit_clearance_items');
    }
};
