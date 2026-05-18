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
        Schema::create('laporan_berkalas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tahun');
            $table->enum('kuartal', ['Q1', 'Q2', 'Q3', 'Q4']);
            $table->decimal('omzet', 15, 2);
            $table->integer('jumlah_karyawan');
            $table->text('kendala')->nullable();
            $table->text('strategi_kedepan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_berkalas');
    }
};
