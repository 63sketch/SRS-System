<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('audit_logs');

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action'); // created, updated, deleted, viewed, exported
            $table->string('action_type')->default('model_change');
            $table->string('entity_type'); // Employee, Leave, Benefit, Document, User, Settings
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('correlation_id')->nullable(); // For tracking related actions
            $table->longText('before_json')->nullable(); // JSON: old values
            $table->longText('after_json')->nullable(); // JSON: new values
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            // Indexes for faster queries
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['entity_type', 'entity_id']);
            $table->index('user_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
