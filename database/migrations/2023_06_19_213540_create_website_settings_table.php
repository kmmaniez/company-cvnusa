<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            // about
            $table->string('tagline_title')->nullable();
            $table->text('tagline_content')->nullable();
            $table->string('title_vision')->nullable();
            $table->text('content_vision')->nullable();
            $table->string('title_mision')->nullable();
            $table->text('content_mision')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
