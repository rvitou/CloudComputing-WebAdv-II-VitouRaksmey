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
        Schema::table('users', function (Blueprint $table) {
            // Add 'country' column for user's country of origin/residence
            // Using string for country code (e.g., 'US', 'KH', 'TH') or full name
            $table->string('country')->nullable()->after('user_nickname');

            // Add 'gender' column
            // Using string for simplicity, could be enum if strict values are preferred
            $table->string('gender')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns if the migration is rolled back
            $table->dropColumn('country');
            $table->dropColumn('gender');
        });
    }
};
