<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Use production seeder for live deployment
        if (app()->environment('production')) {
            $this->call([
                ProductionSeeder::class,
            ]);
        } else {
            // Use development seeders for local testing
            $this->call([
                UserSeeder::class,
                IncidentTypeSeeder::class,
                PositiveReportTypeSeeder::class,
            ]);
        }
    }
}
