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
            if (! Schema::hasColumn('reports', 'status')) {
                $table->string('status')->default('pending');
            }
        });
    }

    public function down(): void
    {
        // intentionally no-op: status owned by create_reports_table migration
    }
};
