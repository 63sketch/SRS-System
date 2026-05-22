<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained()->restrictOnDelete();
            $table->integer('year');
            $table->foreignId('leave_type_id')->constrained()->restrictOnDelete();
            $table->integer('allocated')->default(0);
            $table->integer('used')->default(0);
            $table->integer('adjusted')->default(0);
            $table->integer('carried_over')->default(0);
            $table->primary(['employee_id', 'year', 'leave_type_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};
