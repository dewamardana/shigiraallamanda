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
        Schema::create('cleaning_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cleaning_group_id')->constrained()->cascadeOnDelete(); // gedung
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // yang mengerjakan
            $table->string('member_count'); // angka (1, 2, 3) atau 'random'
            $table->integer('total_room');
            $table->float('total_point')->default(0);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaning_records');
    }
};
