<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@wescliccoffee.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'aktif',
                'email_verified_at' => now(),
            ]
        );

        // Create owner user
        User::updateOrCreate(
            ['email' => 'owner@wescliccoffee.com'],
            [
                'name' => 'Owner',
                'password' => Hash::make('owner123'),
                'role' => 'owner',
                'status' => 'aktif',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: admin@wescliccoffee.com | Password: admin123');
        $this->command->info('Email: owner@wescliccoffee.com | Password: owner123');
    }
}