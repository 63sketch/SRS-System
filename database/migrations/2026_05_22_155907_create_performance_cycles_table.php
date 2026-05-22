<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_cycles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type', ['annual', 'semi_annual', 'probation']);
            $table->enum('status', ['draft', 'active', 'closed'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_cycles');
    }
};
