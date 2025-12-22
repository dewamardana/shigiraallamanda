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
        Schema::table('reports', function (Blueprint $table) {
            // Menambahkan kolom group_id
            $table->foreignId('group_id')
                ->nullable()
                ->constrained('cleaning_groups') // sesuaikan nama tabel group kamu
                ->nullOnDelete()
                ->after('user_id');

            // Menambahkan kolom room_id
            $table->foreignId('room_id')
                ->nullable()
                ->constrained('rooms') // sesuaikan nama tabel room kamu
                ->nullOnDelete()
                ->after('group_id');
            $table->string('status')->default('pending')->after('report_type');
            $table->foreignId('status_updated_by')->nullable()->constrained('users')->nullOnDelete()->after('reply');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['status', 'status_updated_by']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['room_id']);
            $table->dropColumn(['group_id', 'room_id']);
        });
    }
};
