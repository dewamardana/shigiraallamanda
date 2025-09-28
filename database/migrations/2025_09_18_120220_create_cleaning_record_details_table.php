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
        Schema::create('cleaning_record_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cleaning_record_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cleaning_task_id')->constrained()->cascadeOnDelete();
            $table->string('value');             // contoh: "OA", "OV", "Stay", "Vec"
            $table->float('formula')->default(1); // untuk formula dasar
            $table->float('calculated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaning_record_details');
    }
};
