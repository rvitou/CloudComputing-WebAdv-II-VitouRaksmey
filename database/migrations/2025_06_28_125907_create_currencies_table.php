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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing integer
            $table->foreignId('country_id') // Foreign key to 'countries' table
                    ->constrained('countries') // Constraints it to the 'countries' table
                    ->onDelete('cascade'); // If a country is deleted, its currencies are deleted

            $table->string('type'); // Type of currency (e.g., 'Banknote', 'Coin')
            $table->integer('denomination'); // Denomination value (e.g., 1000, 50)
            $table->integer('year'); // Year of issue for the currency note/coin
            $table->string('material')->nullable(); // ADDED THIS LINE: Material of the currency (e.g., 'Paper', 'Polymer', 'Steel')
            $table->date('issue_date')->nullable(); // Date when the currency was issued, can be null
            $table->boolean('is_active')->default(true); // Whether the currency is currently active
            $table->date('deactivated_start_date')->nullable(); // Start date of deactivation, can be null
            $table->date('deactivated_end_date')->nullable(); // End date of deactivation, can be null
            $table->string('front_image_path')->nullable(); // Path to the front image of the currency
            $table->string('back_image_path')->nullable(); // Path to the back image of the currency
            $table->text('description')->nullable(); // Detailed description of the currency
            $table->string('version')->nullable(); // To store version like 'v1', 'v2' etc.
            $table->string('series')->nullable(); // To store series information if applicable

            $table->integer('download_count')->default(0); // Number of times currency images have been downloaded
            $table->integer('view_count')->default(0); // Number of times currency has been viewed

            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies'); // Drop the table if the migration is rolled back
    }
};
