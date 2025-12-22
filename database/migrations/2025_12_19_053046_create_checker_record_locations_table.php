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
        Schema::create('checker_record_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checker_record_detail_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cleaning_group_id')->constrained()->cascadeOnDelete(); // gedung
            $table->json('rooms'); // [1,2,3] atau ["101","102"]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checker_record_locations');
    }
};
