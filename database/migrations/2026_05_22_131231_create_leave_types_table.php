<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('default_allowance')->nullable();
            $table->boolean('requires_attachment')->default(false);
            $table->enum('approval_flow', ['manager_hr', 'hr_only'])->default('manager_hr');
            $table->enum('carry_over_policy', ['none', 'limited', 'unlimited'])->default('none');
            $table->integer('carry_over_limit')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
