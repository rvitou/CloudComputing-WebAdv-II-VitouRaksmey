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
        Schema::create('materials', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing integer
            $table->string('name')->unique(); // Material name (e.g., 'Paper', 'Polymer', 'Steel'), must be unique
            $table->text('description')->nullable(); // Description of the material, can be null
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials'); // Drop the table if the migration is rolled back
    }
};
