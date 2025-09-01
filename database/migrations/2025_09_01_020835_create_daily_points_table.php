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
        Schema::create('daily_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->date('date');
            $table->unsignedBigInteger('activity_id');   // ID aktivitas
            $table->string('activity_type');             // Model aktivitas (Cleaning, Checker, Office, Teaching, dll)
            $table->text('activity_detail');             // Detail JSON
            $table->decimal('point', 8, 2)->default(0);
            $table->timestamps();

            $table->index(['activity_id', 'activity_type']); // biar cepat dicari
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_points');
    }
};
