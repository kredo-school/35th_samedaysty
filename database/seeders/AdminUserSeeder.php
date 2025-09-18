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
        TravelStyle::create([
            'style_name' => 'relaxation',
            'icon_class' => 'fa-solid fa-spa',
            'description' => 'Perfect for those seeking peace and tranquility during their travels.'
        ]);
        TravelStyle::create([
            'style_name' => 'adventure',
            'icon_class' => 'fa-solid fa-person-hiking',
            'description' => 'For thrill-seekers and those who love outdoor activities and challenges.'
        ]);
        TravelStyle::create([
            'style_name' => 'nature',
            'icon_class' => 'fa-solid fa-mountain',
            'description' => 'Explore the great outdoors, national parks, and natural wonders.'
        ]);
        TravelStyle::create([
            'style_name' => 'culture',
            'icon_class' => 'fa-solid fa-landmark',
            'description' => 'Immerse yourself in local traditions, art, and cultural experiences.'
        ]);
        TravelStyle::create([
            'style_name' => 'foodie',
            'icon_class' => 'fa-solid fa-utensils',
            'description' => 'Discover local cuisines and culinary adventures around the world.'
        ]);
        TravelStyle::create([
            'style_name' => 'shopping',
            'icon_class' => 'fa-solid fa-bag-shopping',
            'description' => 'Find the best shopping destinations and unique local products.'
        ]);
        TravelStyle::create([
            'style_name' => 'luxury',
            'icon_class' => 'fa-solid fa-crown',
            'description' => 'Experience the finest accommodations and premium travel services.'
        ]);
        TravelStyle::create([
            'style_name' => 'budget',
            'icon_class' => 'fa-solid fa-wallet',
            'description' => 'Travel smart and economical without compromising on experiences.'
        ]);
        TravelStyle::create([
            'style_name' => 'sustainable',
            'icon_class' => 'fa-solid fa-leaf',
            'description' => 'Eco-friendly travel options that respect the environment.'
        ]);
        TravelStyle::create([
            'style_name' => 'workation',
            'icon_class' => 'fa-solid fa-laptop-house',
            'description' => 'Combine work and travel with remote-friendly destinations.'
        ]);
        TravelStyle::create([
            'style_name' => 'spontaneous',
            'icon_class' => 'fa-solid fa-map',
            'description' => 'Last-minute adventures and flexible travel plans.'
        ]);
        TravelStyle::create([
            'style_name' => 'scenic',
            'icon_class' => 'fa-solid fa-camera-retro',
            'description' => 'Capture breathtaking views and Instagram-worthy moments.'
        ]);

        $this->command->info('Admin, Normal users and Travel Styles created successfully!');
    }
}
