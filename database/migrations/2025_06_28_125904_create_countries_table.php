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
                Schema::create('countries', function (Blueprint $table) {
                    $table->id(); // Primary key, auto-incrementing integer
                    $table->string('name')->unique(); // Country name, must be unique
                    $table->string('slug')->unique(); // URL-friendly slug, must be unique
                    $table->text('description')->nullable(); // Long text description, can be null
                    $table->string('flag_image_path')->nullable(); // Path to the flag image, can be null
                    $table->string('main_currency_image_path')->nullable(); // NEW: Path to the main image for the currency detail page
                    $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
                });
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists('countries'); // Drop the table if the migration is rolled back
            }
        };
        