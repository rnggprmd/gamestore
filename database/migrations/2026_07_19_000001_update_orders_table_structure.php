<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add missing columns
            $table->string('order_id')->unique()->after('id');
            $table->string('customer_email')->nullable()->after('customer_name');
            $table->string('customer_phone')->nullable()->after('customer_email');
            
            // Rename total_price to total_amount for consistency
            $table->renameColumn('total_price', 'total_amount');
            
            // Update status enum values
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled', 'failed'])->default('pending')->change();
            
            // Add admin notes column
            $table->text('admin_notes')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'customer_email', 'customer_phone', 'admin_notes']);
            $table->renameColumn('total_amount', 'total_price');
            $table->enum('status', ['pending', 'processing', 'sent', 'cancelled'])->default('pending')->change();
        });
    }
};
