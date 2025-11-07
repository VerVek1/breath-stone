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
        Schema::table('stones', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        // Заполняем slug для существующих записей
        $stones = \App\Models\Stone::all();
        foreach ($stones as $stone) {
            if (empty($stone->slug)) {
                $baseSlug = \Illuminate\Support\Str::slug($stone->name);
                $slug = $baseSlug;
                $counter = 1;
                
                // Проверяем уникальность slug
                while (\App\Models\Stone::where('slug', $slug)->where('id', '!=', $stone->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                $stone->slug = $slug;
                $stone->save();
            }
        }

        // Теперь добавляем unique constraint
        Schema::table('stones', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stones', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
