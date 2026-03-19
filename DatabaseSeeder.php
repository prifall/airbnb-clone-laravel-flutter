<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the MoonBnb application database.
     *
     * Run: php artisan migrate:fresh --seed
     * Run (demo only): php artisan db:seed --class=DemoDataSeeder
     */
    public function run(): void
    {
        $this->call([
            // 1. Core system configuration
            SettingsSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,

            // 2. Roles & permissions
            RolePermissionSeeder::class,

            // 3. Users
            AdminUserSeeder::class,
            VendorUserSeeder::class,
            GuestUserSeeder::class,

            // 4. Locations (must come before listings)
            LocationSeeder::class,

            // 5. Listing modules
            HotelSeeder::class,
            SpaceSeeder::class,
            TourSeeder::class,
            CarSeeder::class,
            EventSeeder::class,
            BoatSeeder::class,
            FlightSeeder::class,

            // 6. Transactional data
            BookingSeeder::class,
            ReviewSeeder::class,

            // 7. Content
            NewsSeeder::class,
            PlanSeeder::class,

            // 8. Homepage page builder content
            PageSeeder::class,
        ]);

        $this->command->info('✅  MoonBnb database seeded successfully.');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin',  'admin@demo.com',  'password'],
                ['Vendor', 'vendor@demo.com', 'password'],
                ['Guest',  'guest@demo.com',  'password'],
            ]
        );
    }
}
