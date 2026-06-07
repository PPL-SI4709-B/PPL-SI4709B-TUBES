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
            $table->decimal('income', 15, 2)->default(0);
            $table->decimal('expense', 15, 2)->default(0);
            $table->decimal('profit', 15, 2)->default(0);
            $table->text('catatan_usaha')->nullable();
            $table->date('report_date')->nullable();
            $table->string('period')->nullable();
            $table->date('due_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['income', 'expense', 'profit', 'catatan_usaha', 'report_date', 'period', 'due_date']);
        });
    }
};
