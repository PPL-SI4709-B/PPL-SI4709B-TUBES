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
        Schema::create('pengajuan_pendanaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('jumlah_pengajuan', 15, 2);
            $table->string('tujuan_pendanaan');
            $table->text('deskripsi_kebutuhan');
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('status', [
                'diajukan',
                'menunggu_verifikasi',
                'diproses',
                'disetujui',
                'ditolak',
            ])->default('diajukan');
            $table->text('catatan')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pendanaans');
    }
};
