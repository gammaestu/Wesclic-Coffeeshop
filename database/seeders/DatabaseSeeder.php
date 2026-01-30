<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Categories first, then copy images, then seed menus, then settings
        $this->call([
            CategorySeeder::class,
            MenuImageSeeder::class, // Copy images first before seeding menus
            MenuSeeder::class,
            SettingsSeeder::class, // Set default map coordinates
            AdminSeeder::class,
        ]);
    }
}
