<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stones', function (Blueprint $table) {
            if (Schema::hasColumn('stones', 'thickness')) {
                $table->dropColumn('thickness');
            }
        });
    }

    public function down(): void
    {
        Schema::table('stones', function (Blueprint $table) {
            $table->decimal('thickness', 8, 2)->nullable();
        });
    }
};













