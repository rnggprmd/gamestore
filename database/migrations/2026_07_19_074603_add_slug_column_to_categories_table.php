<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add slug column (nullable first)
        if (!Schema::hasColumn('categories', 'slug')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
            });
        }

        // Step 2: Generate slugs for existing categories that don't have one
        $categories = DB::table('categories')->where(function ($query) {
            $query->whereNull('slug')->orWhere('slug', '');
        })->get();

        foreach ($categories as $category) {
            $baseSlug = Str::slug($category->name);
            if (empty($baseSlug)) {
                $baseSlug = 'category-' . $category->id;
            }
            
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure uniqueness
            while (DB::table('categories')->where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            DB::table('categories')->where('id', $category->id)->update(['slug' => $slug]);
        }

        // Step 3: Make slug NOT NULL and UNIQUE
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'slug')) {
                $table->dropIndex(['slug']);
                $table->dropColumn('slug');
            }
        });
    }
};
