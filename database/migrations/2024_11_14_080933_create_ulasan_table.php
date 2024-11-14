<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('ulasan_id');  // Primary key untuk tabel ulasan

            // Foreign key yang merujuk pada 'id' di tabel 'users'
            $table->unsignedBigInteger('user_id');  // Menggunakan unsignedBigInteger untuk konsisten
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key yang merujuk pada 'warung_id' di tabel 'warung'
            $table->unsignedBigInteger('warung_id');  // Menggunakan unsignedBigInteger untuk konsisten
            $table->foreign('warung_id')->references('warung_id')->on('warung')->onDelete('cascade');

            // Rating (nilai 1-5), komentar, dan timestamp
            $table->unsignedTinyInteger('rating');  // Rating sebagai angka antara 1 dan 5
            $table->text('komentar')->nullable();   // Kolom komentar, bisa null
            $table->timestamp('tanggal_ulasan')->default(DB::raw('CURRENT_TIMESTAMP')); // Waktu ulasan dibuat
        });

        // Menambahkan constraint untuk memastikan rating antara 1-5
        DB::statement('ALTER TABLE ulasan ADD CONSTRAINT check_rating CHECK (rating BETWEEN 1 AND 5)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
