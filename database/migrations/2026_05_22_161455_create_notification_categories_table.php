<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key_name', 100)->unique();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->boolean('is_system_wide_enabled')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_categories');
    }
};
