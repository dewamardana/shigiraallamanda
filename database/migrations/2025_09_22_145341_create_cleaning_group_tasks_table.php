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
        Schema::create('cleaning_group_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cleaning_group_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cleaning_task_id')->constrained()->cascadeOnDelete();
            $table->float('formula')->default(0); // default poin untuk task ini di group tsb
            $table->timestamps();

            $table->unique(['cleaning_group_id', 'cleaning_task_id']); // supaya 1 task tidak dobel di satu group
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaning_group_tasks');
    }
};
