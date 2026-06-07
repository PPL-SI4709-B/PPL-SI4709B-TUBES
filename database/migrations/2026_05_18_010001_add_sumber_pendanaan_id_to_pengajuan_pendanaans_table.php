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
        Schema::table('pengajuan_pendanaans', function (Blueprint $table) {
            $table->foreignId('sumber_pendanaan_id')
                ->nullable()
                ->after('user_id')
                ->constrained('sumber_pendanaans')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_pendanaans', function (Blueprint $table) {
            $table->dropForeign(['sumber_pendanaan_id']);
            $table->dropColumn('sumber_pendanaan_id');
        });
    }
};
