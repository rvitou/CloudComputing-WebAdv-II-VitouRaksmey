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
        Schema::create('currency_material', function (Blueprint $table) {
            $table->foreignId('currency_id') // Foreign key to 'currencies' table
                  ->constrained('currencies')
                  ->onDelete('cascade'); // If a currency is deleted, pivot entries are deleted

            $table->foreignId('material_id') // Foreign key to 'materials' table
                  ->constrained('materials')
                  ->onDelete('cascade'); // If a material is deleted, pivot entries are deleted

            $table->decimal('percentage', 5, 2)->nullable(); // Percentage of this material in the currency, can be null
            $table->timestamps(); // Adds 'created_at' and 'updated_at'

            $table->primary(['currency_id', 'material_id']); // Composite primary key for uniqueness
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_material'); // Drop the table if the migration is rolled back
    }
};
