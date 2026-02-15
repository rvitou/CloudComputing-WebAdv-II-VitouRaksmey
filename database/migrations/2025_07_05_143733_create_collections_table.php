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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('currency_id')->constrained()->onDelete('cascade'); // Foreign key to currencies table
            $table->timestamps();

            // Optional: Add a unique constraint to prevent duplicate entries for the same user/currency
            $table->unique(['user_id', 'currency_id']);

            // Optional: Add other fields if a user collects multiple of the same currency
            // $table->integer('quantity')->default(1);
            // $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
