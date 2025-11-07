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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // материал
            $table->timestamps();
        });

        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // производитель
            $table->string('country')->nullable(); // страна производителя
            $table->timestamps();
        });

        Schema::create('stones', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // название
            $table->string('sku')->unique(); // артикул
            $table->foreignId('material_id')->nullable()->constrained('materials')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers')->cascadeOnUpdate()->nullOnDelete();
            $table->decimal('thickness', 8, 2)->nullable(); // толщина (мм)
            $table->string('color')->nullable(); // цвет
            $table->string('texture')->nullable(); // текстура
            $table->string('photo_path')->nullable(); // фото (путь к файлу)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stones');
        Schema::dropIfExists('manufacturers');
        Schema::dropIfExists('materials');
    }
};


