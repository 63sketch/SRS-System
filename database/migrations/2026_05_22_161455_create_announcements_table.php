<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('body');
            $table->foreignId('author_id')->constrained('users')->restrictOnDelete();
            $table->enum('audience_type', ['all', 'department', 'role']);
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('role_id')->nullable()->constrained()->nullOnDelete();
            $table->date('publish_date');
            $table->date('expiry_date')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->boolean('requires_acknowledgment')->default(false);
            $table->string('attachment_path', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
