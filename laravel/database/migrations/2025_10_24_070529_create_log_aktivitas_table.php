<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('action'); // e.g., 'create', 'update', 'delete', 'use_stock'
            $table->string('model_type')->nullable(); // e.g., 'App\\Models\\Stock'
            $table->unsignedBigInteger('model_id')->nullable(); // ID dari instance model yang terpengaruh
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
