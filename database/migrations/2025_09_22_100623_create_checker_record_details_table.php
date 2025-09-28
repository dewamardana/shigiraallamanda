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
        Schema::create('checker_record_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checker_record_id')->constrained()->cascadeOnDelete();
            $table->foreignId('checker_task_id')->constrained()->cascadeOnDelete();
            $table->string('value');          // nilai input user
            $table->float('formula')->default(1);
            $table->float('calculated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checker_record_details');
    }
};
