<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Run the application's database.
         */
        public function run(): void
        {
            // ... (Your existing User seeding code) ...
            User::firstOrCreate(
                ['email' => '123vitou@gmail.com'],
                [
                    'user_fullname' => 'Vitou Raksmey',
                    'user_nickname' => 'Tou',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'country' => 'KHM',
                    'gender' => 'Male',
                ]
            );
            User::firstOrCreate(
                ['email' => 'jane@example.com'],
                [
                    'user_fullname' => 'Jane Smith',
                    'user_nickname' => 'Janie',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'country' => 'USA',
                    'gender' => 'Female',
                ]
            );
            User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'user_fullname' => 'Admin User',
                    'user_nickname' => 'Admin',
                    'password' => Hash::make('adminpassword'),
                    'email_verified_at' => now(),
                    'country' => 'THA',
                    'gender' => 'Male',
                ]
            );
            User::firstOrCreate(
                ['email' => 'alice@example.com'],
                [
                    'user_fullname' => 'Alice Wonderland',
                    'user_nickname' => 'Alice',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'country' => 'GBR',
                    'gender' => 'Female',
                ]
            );

            $this->command->info('Users seeded successfully!');

            $this->call([
                CountrySeeder::class,
                CurrencySeeder::class,
                CollectionSeeder::class, // <-- Make sure this line is present and uncommented
            ]);

            $this->command->info('Database seeding completed successfully!');
        }
    }
    