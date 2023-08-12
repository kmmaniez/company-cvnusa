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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->foreignId('jabatan_id');
            // $table->foreignId('jabatan_id')->references('id')->on('jabatans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('foto_anggota')->nullable();
            $table->string('url_facebook')->nullable();
            $table->string('url_twitter')->nullable();
            $table->string('url_linkedin')->nullable();
            $table->string('url_instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
