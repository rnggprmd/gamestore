<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Game;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Banner;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key constraints
        Schema::disableForeignKeyConstraints();

        // Clear existing data
        User::truncate();
        Setting::truncate();
        Banner::truncate();
        Category::truncate();
        Game::truncate();
        Product::truncate();
        Testimonial::truncate();

        // Enable foreign key constraints
        Schema::enableForeignKeyConstraints();

        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@gamestore.com'],
            [
                'name' => 'Admin Gamestore',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Store Settings
        Setting::create([
            'store_name' => 'Gamestore Indonesia',
            'logo' => null,
            'favicon' => null,
            'whatsapp' => '628123456789',
            'whatsapp_channel' => 'https://whatsapp.com/channel/example',
            'youtube_tutorial' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'instagram' => 'https://instagram.com/gamestore.id',
            'facebook' => 'https://facebook.com/gamestore.id',
            'discord' => 'https://discord.gg/gamestore',
            'address' => 'Jl. Gamer No. 12, Jakarta',
            'footer' => 'Gamestore Indonesia - Penyedia Top Up Game Instan Terlengkap & Terpercaya.',
            'operating_hours' => '09:00 - 22:00 WIB',
            'meta_description' => 'Top Up game online murah, cepat, dan aman 24 jam.',
            'meta_keywords' => 'top up game, roblox, robux, mobile legends, free fire',
            'whatsapp_clicks' => 0,
        ]);
    }
}
