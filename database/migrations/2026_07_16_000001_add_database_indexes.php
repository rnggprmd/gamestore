<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        try {
            // Games indexes
            if (Schema::hasTable('games') && Schema::hasColumn('games', 'slug')) {
                DB::statement('ALTER TABLE games ADD INDEX idx_games_slug (slug)');
            }
        } catch (\Exception $e) {
            // Index might already exist
        }

        try {
            if (Schema::hasTable('games') && Schema::hasColumn('games', 'status')) {
                DB::statement('ALTER TABLE games ADD INDEX idx_games_status (status)');
            }
        } catch (\Exception $e) {
            // Index might already exist
        }

        try {
            // Products indexes
            if (Schema::hasTable('products') && Schema::hasColumn('products', 'status')) {
                DB::statement('ALTER TABLE products ADD INDEX idx_products_status (status)');
            }
        } catch (\Exception $e) {
            // Index might already exist
        }

        try {
            if (Schema::hasTable('products') && Schema::hasColumn('products', 'game_id')) {
                DB::statement('ALTER TABLE products ADD INDEX idx_products_game_status (game_id, status)');
            }
        } catch (\Exception $e) {
            // Index might already exist
        }

        try {
            if (Schema::hasTable('products') && Schema::hasColumn('products', 'category_id')) {
                DB::statement('ALTER TABLE products ADD INDEX idx_products_category_status (category_id, status)');
            }
        } catch (\Exception $e) {
            // Index might already exist
        }

        try {
            // Banners indexes
            if (Schema::hasTable('banners') && Schema::hasColumn('banners', 'status')) {
                DB::statement('ALTER TABLE banners ADD INDEX idx_banners_status (status)');
            }
        } catch (\Exception $e) {
            // Index might already exist
        }

        try {
            // Testimonials indexes
            if (Schema::hasTable('testimonials') && Schema::hasColumn('testimonials', 'status')) {
                DB::statement('ALTER TABLE testimonials ADD INDEX idx_testimonials_status (status)');
            }
        } catch (\Exception $e) {
            // Index might already exist
        }
    }

    public function down(): void
    {
        try {
            if (Schema::hasTable('games')) {
                DB::statement('ALTER TABLE games DROP INDEX IF EXISTS idx_games_slug');
            }
        } catch (\Exception $e) {}

        try {
            if (Schema::hasTable('games')) {
                DB::statement('ALTER TABLE games DROP INDEX IF EXISTS idx_games_status');
            }
        } catch (\Exception $e) {}

        try {
            if (Schema::hasTable('products')) {
                DB::statement('ALTER TABLE products DROP INDEX IF EXISTS idx_products_status');
            }
        } catch (\Exception $e) {}

        try {
            if (Schema::hasTable('products')) {
                DB::statement('ALTER TABLE products DROP INDEX IF EXISTS idx_products_game_status');
            }
        } catch (\Exception $e) {}

        try {
            if (Schema::hasTable('products')) {
                DB::statement('ALTER TABLE products DROP INDEX IF EXISTS idx_products_category_status');
            }
        } catch (\Exception $e) {}

        try {
            if (Schema::hasTable('banners')) {
                DB::statement('ALTER TABLE banners DROP INDEX IF EXISTS idx_banners_status');
            }
        } catch (\Exception $e) {}

        try {
            if (Schema::hasTable('testimonials')) {
                DB::statement('ALTER TABLE testimonials DROP INDEX IF EXISTS idx_testimonials_status');
            }
        } catch (\Exception $e) {}
    }
};