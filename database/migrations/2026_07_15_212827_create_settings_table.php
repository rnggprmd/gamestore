<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('store_name');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            $table->string('whatsapp');
            $table->string('whatsapp_channel')->nullable();
            $table->string('youtube_tutorial')->nullable();

            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('discord')->nullable();

            $table->text('address')->nullable();
            $table->text('footer')->nullable();

            // Additional Admin Settings
            $table->unsignedInteger('whatsapp_clicks')->default(0);
            $table->string('operating_hours')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};