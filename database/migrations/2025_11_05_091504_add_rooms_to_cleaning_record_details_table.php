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
        Schema::table('cleaning_record_details', function (Blueprint $table) {
            $table->json('rooms')->nullable()->after('value'); // contoh "1,3,4,5,6"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cleaning_record_details', function (Blueprint $table) {
            $table->dropColumn('rooms');
        });
    }
};
