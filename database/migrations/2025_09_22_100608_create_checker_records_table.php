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
        Schema::create('checker_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->float('total_point')->default(0);
            $table->timestamps();


            // Schema::create('check_records', function (Blueprint $table) {
            //     $table->id();
            //     $table->foreignId('check_id')->constrained()->restrictOnDelete();
            //     $table->unsignedInteger('jumlah_kamar')->default(0);
            //     $table->float('mengajar')->default(0);
            //     $table->float('pembersihan_khusus')->default(0);
            //     $table->float('mengangkat_barang')->default(0);
            //     $table->float('membersihkan_gudang')->default(0);
            //     $table->float('obat_pool')->default(0);
            //     $table->float('membersihkan_pool')->default(0);
            //     $table->float('sampah')->default(0);
            //     $table->unsignedInteger('total')->default(0);
            //     $table->timestamps();
            // });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checker_records');
    }
};
