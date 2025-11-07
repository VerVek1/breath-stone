<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stone;
use Illuminate\Support\Str;

class StoneSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stone::all()->each(function ($stone) {
            if (empty($stone->slug)) {
                $baseSlug = Str::slug($stone->name);
                $slug = $baseSlug;
                $counter = 1;
                
                // Проверяем уникальность slug
                while (Stone::where('slug', $slug)->where('id', '!=', $stone->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                $stone->slug = $slug;
                $stone->save();
            }
        });
    }
}











