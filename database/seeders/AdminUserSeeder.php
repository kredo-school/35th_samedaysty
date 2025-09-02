<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TravelStyle;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'avatar' => '/images/admin-avatar.png',
            'bio' => 'System Administrator',
            'role_id' => 1, // Admin
        ]);

        // Create normal user (sample)
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'avatar' => '/images/user-avatar.png',
            'bio' => 'Regular user',
            'role_id' => 2, // Normal User
        ]);

        // Create Travel Styles
        TravelStyle::create(['style_name' => 'chill']);
        TravelStyle::create(['style_name' => 'activity']);
        TravelStyle::create(['style_name' => 'adventure']);
        TravelStyle::create(['style_name' => 'culture']);
        TravelStyle::create(['style_name' => 'history']);
        TravelStyle::create(['style_name' => 'relax']);
        TravelStyle::create(['style_name' => 'city']);
        TravelStyle::create(['style_name' => 'food']);
        TravelStyle::create(['style_name' => 'nature']);

        $this->command->info('Admin, Normal users and Travel Styles created successfully!');
    }
}
