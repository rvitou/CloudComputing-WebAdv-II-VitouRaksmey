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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing integer

            // Added based on your ERD
            $table->string('user_fullname')->nullable(); // User's full name, can be null
            $table->string('user_nickname')->nullable(); // User's nickname, can be null

            $table->string('email')->unique(); // User's email address, must be unique
            $table->timestamp('email_verified_at')->nullable(); // Timestamp for email verification
            $table->string('password'); // Hashed password
            $table->rememberToken(); // For "remember me" functionality
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drop the table if the migration is rolled back
    }
};
