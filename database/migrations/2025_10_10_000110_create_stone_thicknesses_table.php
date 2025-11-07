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
        Schema::create('stone_thicknesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stone_id')->constrained('stones')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('thickness_mm', 8, 2); // значение толщины в миллиметрах
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stone_thicknesses');
    }
};













