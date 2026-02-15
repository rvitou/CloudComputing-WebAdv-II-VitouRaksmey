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
        Schema::create('download_logs', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing integer
            $table->foreignId('user_id') // Foreign key to 'users' table
                  ->constrained('users') // Constraints it to the 'users' table
                  ->onDelete('cascade'); // If a user is deleted, their download logs are deleted

            $table->foreignId('currency_id') // Foreign key to 'currencies' table
                  ->constrained('currencies') // Constraints it to the 'currencies' table
                  ->onDelete('cascade'); // If a currency is deleted, its download logs are deleted

            $table->timestamp('downloaded_at')->useCurrent(); // Timestamp of when the download occurred
            $table->string('ip_address')->nullable(); // IP address of the downloader
            $table->timestamps(); // Adds 'created_at' and 'updated_at' (though downloaded_at is more specific)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_logs'); // Drop the table if the migration is rolled back
    }
};
