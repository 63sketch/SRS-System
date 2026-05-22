<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcement_acknowledgments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->constrained()->restrictOnDelete();
            $table->foreignId('employee_id')->constrained()->restrictOnDelete();
            $table->timestamp('acknowledged_at');
            $table->unique(['announcement_id', 'employee_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcement_acknowledgments');
    }
};
