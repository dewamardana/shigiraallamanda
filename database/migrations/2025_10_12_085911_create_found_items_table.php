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
        Schema::create('found_items', function (Blueprint $table) {
            $table->id();
            // Tanggal penemuan
            $table->date('date');

            // Relasi ke user (yang menemukan)
            $table->foreignId('found_by_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');

            // Lokasi atau tempat ditemukan
            $table->string('location');


            // Deskripsi singkat barang
            $table->text('description');

            // Nomor seri atau tanda unik barang (opsional)
            $table->string('serial_number')->nullable();

            // File media (foto/video) dalam format JSON
            $table->json('media_files')->nullable();

            // Status barang (opsional, misal "unclaimed", "claimed")
            $table->integer('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_items');
    }
};
