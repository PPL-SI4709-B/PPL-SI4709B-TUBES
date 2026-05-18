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
        Schema::create('sumber_pendanaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('mitra_penyalur');
            $table->decimal('batas_maksimal', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->text('persyaratan')->nullable();
            $table->string('status')->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_pendanaans');
    }
};
