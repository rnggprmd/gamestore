<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Customer info
            $table->string('customer_name');
            $table->string('whatsapp')->nullable();

            // Order totals & status
            $table->decimal('total_price', 12, 2)->default(0);
            $table->enum('status', ['pending', 'processing', 'sent', 'cancelled'])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};