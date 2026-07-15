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
use Illuminate\Support\Str;

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
            ]
        );

        // Store Settings
        Setting::create([
            'store_name' => 'Gamestore Indonesia',
            'logo' => null,
            'favicon' => null,
            'whatsapp' => '628123456789',
            'whatsapp_channel' => 'https://whatsapp.com/channel/example',
            'youtube_tutorial' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Default youtube video
            'instagram' => 'https://instagram.com/gamestore.id',
            'facebook' => 'https://facebook.com/gamestore.id',
            'discord' => 'https://discord.gg/gamestore',
            'address' => 'Jl. Gamer No. 12, Jakarta',
            'footer' => 'Gamestore Indonesia - Penyedia Top Up Game Instan Terlengkap & Terpercaya.',
            'operating_hours' => '09:00 - 22:00 WIB',
            'meta_description' => 'Penyedia top up game instan terlengkap, termurah, dan terpercaya di Indonesia. Mobile Legends, Valorant, PUBG, Genshin, dll.',
            'meta_keywords' => 'topup game, diamond mlbb, valorant points, uc pubg, murah, instan, gamestore',
            'whatsapp_clicks' => 0,
        ]);

        // Banners
        Banner::create([
            'title' => 'Top Up Instan 24 Jam Non-Stop',
            'subtitle' => 'Dapatkan diskon hingga 30% untuk seluruh game populer. Proses cepat otomatis!',
            'image' => 'banner1.jpg',
            'button_text' => 'Beli Sekarang',
            'button_link' => '#games',
            'status' => true,
        ]);
        Banner::create([
            'title' => 'Weekly Special Offers',
            'subtitle' => 'Dapatkan harga khusus untuk Weekly Diamond Pass MLBB dan Welkin Moon Genshin Impact.',
            'image' => 'banner2.jpg',
            'button_text' => 'Cek Promo',
            'button_link' => '#games',
            'status' => true,
        ]);

        // Categories — hanya 2: Item dan Game Pass
        $catItem     = Category::create(['name' => 'Item']);
        $catGamePass = Category::create(['name' => 'Game Pass']);

        // Game 1: Mobile Legends
        $mlbb = Game::create([
            'name'        => 'Mobile Legends: Bang Bang',
            'slug'        => 'mobile-legends',
            'thumbnail'   => 'mlbb.jpg',
            'banner'      => 'mlbb-banner.jpg',
            'description' => 'Top Up Diamond MLBB Murah dan Cepat. Masukkan User ID dan Zone ID Anda.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catItem->id, 'name' => 'Diamond 86',   'price' => 20000, 'status' => true]);
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catItem->id, 'name' => 'Diamond 172',  'price' => 40000, 'status' => true]);
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catItem->id, 'name' => 'Diamond 257',  'price' => 60000, 'status' => true]);
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catItem->id, 'name' => 'Diamond 515',  'price' => 115000, 'status' => true]);
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catItem->id, 'name' => 'Diamond 1029', 'price' => 230000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catGamePass->id, 'name' => 'Weekly Pass',         'price' => 28000,  'status' => true]);
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catGamePass->id, 'name' => 'Twilight Pass',       'price' => 150000, 'status' => true]);
        Product::create(['game_id' => $mlbb->id, 'category_id' => $catGamePass->id, 'name' => 'Starlight Membership', 'price' => 140000, 'status' => true]);

        // Game 2: Valorant
        $valorant = Game::create([
            'name'        => 'Valorant',
            'slug'        => 'valorant',
            'thumbnail'   => 'valorant.jpg',
            'banner'      => 'valorant-banner.jpg',
            'description' => 'Beli Valorant Points Instan. Masukkan Riot ID + Tagline Anda (contoh: Username#1234).',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $valorant->id, 'category_id' => $catItem->id, 'name' => '125 VP',  'price' => 15000,  'status' => true]);
        Product::create(['game_id' => $valorant->id, 'category_id' => $catItem->id, 'name' => '420 VP',  'price' => 50000,  'status' => true]);
        Product::create(['game_id' => $valorant->id, 'category_id' => $catItem->id, 'name' => '1000 VP', 'price' => 115000, 'status' => true]);
        Product::create(['game_id' => $valorant->id, 'category_id' => $catItem->id, 'name' => '2050 VP', 'price' => 230000, 'status' => true]);
        Product::create(['game_id' => $valorant->id, 'category_id' => $catItem->id, 'name' => '3650 VP', 'price' => 405000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $valorant->id, 'category_id' => $catGamePass->id, 'name' => 'Battle Pass',    'price' => 160000, 'status' => true]);
        Product::create(['game_id' => $valorant->id, 'category_id' => $catGamePass->id, 'name' => 'Kingdom Pass',   'price' => 160000, 'status' => true]);

        // Game 3: PUBG Mobile
        $pubg = Game::create([
            'name'        => 'PUBG Mobile',
            'slug'        => 'pubg-mobile',
            'thumbnail'   => 'pubg.jpg',
            'banner'      => 'pubg-banner.jpg',
            'description' => 'Top Up Unknown Cash (UC) PUBG Mobile. Cukup masukkan Character ID Anda.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $pubg->id, 'category_id' => $catItem->id, 'name' => '60 UC',   'price' => 14000,  'status' => true]);
        Product::create(['game_id' => $pubg->id, 'category_id' => $catItem->id, 'name' => '325 UC',  'price' => 70000,  'status' => true]);
        Product::create(['game_id' => $pubg->id, 'category_id' => $catItem->id, 'name' => '660 UC',  'price' => 140000, 'status' => true]);
        Product::create(['game_id' => $pubg->id, 'category_id' => $catItem->id, 'name' => '1800 UC', 'price' => 350000, 'status' => true]);
        Product::create(['game_id' => $pubg->id, 'category_id' => $catItem->id, 'name' => '3850 UC', 'price' => 700000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $pubg->id, 'category_id' => $catGamePass->id, 'name' => 'Royal Pass M (Tier 1)',  'price' => 150000, 'status' => true]);
        Product::create(['game_id' => $pubg->id, 'category_id' => $catGamePass->id, 'name' => 'Royal Pass M (Tier 25)', 'price' => 250000, 'status' => true]);
        Product::create(['game_id' => $pubg->id, 'category_id' => $catGamePass->id, 'name' => 'Royal Pass M (Tier 50)', 'price' => 450000, 'status' => true]);

        // Game 4: Free Fire
        $ff = Game::create([
            'name'        => 'Free Fire',
            'slug'        => 'free-fire',
            'thumbnail'   => 'ff.jpg',
            'banner'      => 'ff-banner.jpg',
            'description' => 'Top Up Diamond Free Fire termurah. Masukkan Player ID Anda.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $ff->id, 'category_id' => $catItem->id, 'name' => '50 Diamonds',  'price' => 8000,  'status' => true]);
        Product::create(['game_id' => $ff->id, 'category_id' => $catItem->id, 'name' => '100 Diamonds', 'price' => 15000, 'status' => true]);
        Product::create(['game_id' => $ff->id, 'category_id' => $catItem->id, 'name' => '310 Diamonds', 'price' => 45000, 'status' => true]);
        Product::create(['game_id' => $ff->id, 'category_id' => $catItem->id, 'name' => '520 Diamonds', 'price' => 75000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $ff->id, 'category_id' => $catGamePass->id, 'name' => 'Weekly Membership',  'price' => 30000,  'status' => true]);
        Product::create(['game_id' => $ff->id, 'category_id' => $catGamePass->id, 'name' => 'Monthly Membership', 'price' => 150000, 'status' => true]);

        // Game 5: Honor of Kings
        $hok = Game::create([
            'name'        => 'Honor of Kings',
            'slug'        => 'honor-of-kings',
            'thumbnail'   => 'hok.jpg',
            'banner'      => 'hok-banner.jpg',
            'description' => 'Top Up Tokens Honor of Kings. Cukup masukkan User ID Anda.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $hok->id, 'category_id' => $catItem->id, 'name' => '80 Tokens',  'price' => 16000,  'status' => true]);
        Product::create(['game_id' => $hok->id, 'category_id' => $catItem->id, 'name' => '240 Tokens', 'price' => 48000,  'status' => true]);
        Product::create(['game_id' => $hok->id, 'category_id' => $catItem->id, 'name' => '400 Tokens', 'price' => 78000,  'status' => true]);
        Product::create(['game_id' => $hok->id, 'category_id' => $catItem->id, 'name' => '800 Tokens', 'price' => 155000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $hok->id, 'category_id' => $catGamePass->id, 'name' => 'Moon Token Pass', 'price' => 79000,  'status' => true]);
        Product::create(['game_id' => $hok->id, 'category_id' => $catGamePass->id, 'name' => 'Season Pass',     'price' => 149000, 'status' => true]);

        // Game 6: Genshin Impact
        $genshin = Game::create([
            'name'        => 'Genshin Impact',
            'slug'        => 'genshin-impact',
            'thumbnail'   => 'genshin.jpg',
            'banner'      => 'genshin-banner.jpg',
            'description' => 'Top Up Genesis Crystals Genshin Impact. Masukkan UID dan pilih Server Anda dengan benar.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $genshin->id, 'category_id' => $catItem->id, 'name' => '60 Genesis Crystals',   'price' => 15000,  'status' => true]);
        Product::create(['game_id' => $genshin->id, 'category_id' => $catItem->id, 'name' => '300 Genesis Crystals',  'price' => 75000,  'status' => true]);
        Product::create(['game_id' => $genshin->id, 'category_id' => $catItem->id, 'name' => '980 Genesis Crystals',  'price' => 230000, 'status' => true]);
        Product::create(['game_id' => $genshin->id, 'category_id' => $catItem->id, 'name' => '1980 Genesis Crystals', 'price' => 450000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $genshin->id, 'category_id' => $catGamePass->id, 'name' => 'Welkin Moon',   'price' => 79000,  'status' => true]);
        Product::create(['game_id' => $genshin->id, 'category_id' => $catGamePass->id, 'name' => 'Gnostic Hymn',  'price' => 149000, 'status' => true]);
        Product::create(['game_id' => $genshin->id, 'category_id' => $catGamePass->id, 'name' => 'Gnostic Chorus', 'price' => 149000, 'status' => true]);

        // Game 7: Honkai: Star Rail
        $hsr = Game::create([
            'name'        => 'Honkai: Star Rail',
            'slug'        => 'honkai-star-rail',
            'thumbnail'   => 'hsr.jpg',
            'banner'      => 'hsr-banner.jpg',
            'description' => 'Top Up Oneiric Shards Honkai: Star Rail. Masukkan UID dan pilih Server Anda.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $hsr->id, 'category_id' => $catItem->id, 'name' => '60 Oneiric Shards',   'price' => 15000,  'status' => true]);
        Product::create(['game_id' => $hsr->id, 'category_id' => $catItem->id, 'name' => '300 Oneiric Shards',  'price' => 75000,  'status' => true]);
        Product::create(['game_id' => $hsr->id, 'category_id' => $catItem->id, 'name' => '980 Oneiric Shards',  'price' => 230000, 'status' => true]);
        Product::create(['game_id' => $hsr->id, 'category_id' => $catItem->id, 'name' => '1980 Oneiric Shards', 'price' => 450000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $hsr->id, 'category_id' => $catGamePass->id, 'name' => 'Express Supply Pass', 'price' => 79000,  'status' => true]);
        Product::create(['game_id' => $hsr->id, 'category_id' => $catGamePass->id, 'name' => 'Nameless Honor',      'price' => 149000, 'status' => true]);

        // Game 8: Roblox
        $roblox = Game::create([
            'name'        => 'Roblox',
            'slug'        => 'roblox',
            'thumbnail'   => 'roblox.jpg',
            'banner'      => 'roblox-banner.jpg',
            'description' => 'Top Up Robux murah dan legal. Cukup masukkan Username Roblox Anda.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $roblox->id, 'category_id' => $catItem->id, 'name' => '80 Robux',   'price' => 16000,  'status' => true]);
        Product::create(['game_id' => $roblox->id, 'category_id' => $catItem->id, 'name' => '400 Robux',  'price' => 75000,  'status' => true]);
        Product::create(['game_id' => $roblox->id, 'category_id' => $catItem->id, 'name' => '800 Robux',  'price' => 145000, 'status' => true]);
        Product::create(['game_id' => $roblox->id, 'category_id' => $catItem->id, 'name' => '1700 Robux', 'price' => 290000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $roblox->id, 'category_id' => $catGamePass->id, 'name' => 'Roblox Premium 450',  'price' => 70000,  'status' => true]);
        Product::create(['game_id' => $roblox->id, 'category_id' => $catGamePass->id, 'name' => 'Roblox Premium 1000', 'price' => 140000, 'status' => true]);
        Product::create(['game_id' => $roblox->id, 'category_id' => $catGamePass->id, 'name' => 'Roblox Premium 2200', 'price' => 280000, 'status' => true]);

        // Game 9: Steam Wallet
        $steam = Game::create([
            'name'        => 'Steam Wallet Code IDR',
            'slug'        => 'steam-wallet',
            'thumbnail'   => 'steam.jpg',
            'banner'      => 'steam-banner.jpg',
            'description' => 'Beli Steam Wallet Code Instan. Masukkan nomor WhatsApp untuk pengiriman kode.',
            'status'      => true,
        ]);
        // Item
        Product::create(['game_id' => $steam->id, 'category_id' => $catItem->id, 'name' => 'Steam IDR 45.000',  'price' => 52000,  'status' => true]);
        Product::create(['game_id' => $steam->id, 'category_id' => $catItem->id, 'name' => 'Steam IDR 90.000',  'price' => 102000, 'status' => true]);
        Product::create(['game_id' => $steam->id, 'category_id' => $catItem->id, 'name' => 'Steam IDR 250.000', 'price' => 278000, 'status' => true]);
        Product::create(['game_id' => $steam->id, 'category_id' => $catItem->id, 'name' => 'Steam IDR 500.000', 'price' => 555000, 'status' => true]);
        // Game Pass
        Product::create(['game_id' => $steam->id, 'category_id' => $catGamePass->id, 'name' => 'Steam Game Pass (1 Bulan)', 'price' => 75000,  'status' => true]);
        Product::create(['game_id' => $steam->id, 'category_id' => $catGamePass->id, 'name' => 'Steam Game Pass (3 Bulan)', 'price' => 200000, 'status' => true]);




        // Testimonials
        Testimonial::create([
            'customer_name' => 'Ahmad Fauzi',
            'message' => 'Proses top up MLBB cuma 1 menit langsung masuk. Seller ramah dan murah banget!',
            'image' => null,
            'rating' => 5,
            'status' => true,
        ]);
        Testimonial::create([
            'customer_name' => 'Rian Kurnia',
            'message' => 'Beli Welkin Genshin murah di sini aman terpercaya. Gak perlu cemas minus genesis.',
            'image' => null,
            'rating' => 5,
            'status' => true,
        ]);
        Testimonial::create([
            'customer_name' => 'Sarah Wijaya',
            'message' => 'Langganan top up Valorant Points selalu lancar jaya. Layanan 24 jam responsif!',
            'image' => null,
            'rating' => 5,
            'status' => true,
        ]);
    }
}
