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
            $table->foreignId('cleaning_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('member_count'); // angka (1, 2, 3) atau 'random'
            $table->float('oa');
            $table->float('ov');
            $table->float('stay');
            $table->float('vec');
            $table->float('premier')->nullable(); // opsional, cuma untuk royal
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
