<?php

namespace App\Http\Controllers;

use App\Models\Stone;

class StoneCatalogController extends Controller
{
    public function index()
    {
        $stones = Stone::with(['material', 'manufacturer', 'thicknesses'])
            ->orderBy('name')
            ->paginate(12);

        return view('catalog-kamnya', compact('stones'));
    }

    public function show(Stone $stone)
    {
        $stone->load(['material', 'manufacturer', 'thicknesses']);

        // Подбор похожих материалов по типу материала
        $relatedStones = collect();
        if ($stone->material) {
            $relatedStones = Stone::with(['material', 'manufacturer'])
                ->where('id', '!=', $stone->id)
                ->where('material_id', $stone->material_id)
                ->orderBy('name')
                ->take(8)
                ->get();
        }

        // Если похожих материалов по типу мало, добавляем по цвету
        if ($relatedStones->count() < 4 && $stone->color) {
            $colorRelated = Stone::with(['material', 'manufacturer'])
                ->where('id', '!=', $stone->id)
                ->where('color', $stone->color)
                ->whereNotIn('id', $relatedStones->pluck('id'))
                ->orderBy('name')
                ->take(8 - $relatedStones->count())
                ->get();
            
            $relatedStones = $relatedStones->merge($colorRelated);
        }

        return view('stones.show', compact('stone', 'relatedStones'));
    }
}




