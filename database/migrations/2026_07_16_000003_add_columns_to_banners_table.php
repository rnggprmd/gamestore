<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('banners')) {
            Schema::table('banners', function (Blueprint $table) {
                // Rename subtitle to description if exists
                if (Schema::hasColumn('banners', 'subtitle')) {
                    // We can't directly rename in all databases, so we'll add description and keep subtitle
                    if (!Schema::hasColumn('banners', 'description')) {
                        $table->text('description')->nullable()->after('title');
                    }
                }
                
                // Add link column (button_link might be renamed)
                if (!Schema::hasColumn('banners', 'link')) {
                    $table->string('link')->nullable()->after('image');
                }
                
                // Add order column for sorting
                if (!Schema::hasColumn('banners', 'order')) {
                    $table->integer('order')->default(0)->after('status');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('banners')) {
            Schema::table('banners', function (Blueprint $table) {
                if (Schema::hasColumn('banners', 'description')) {
                    $table->dropColumn('description');
                }
                if (Schema::hasColumn('banners', 'link')) {
                    $table->dropColumn('link');
                }
                if (Schema::hasColumn('banners', 'order')) {
                    $table->dropColumn('order');
                }
            });
        }
    }
};
