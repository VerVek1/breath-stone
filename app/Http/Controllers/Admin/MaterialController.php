<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::orderBy('name')->paginate(20);
        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.materials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:materials,name'],
        ]);

        Material::create($validated);

        return redirect()->route('admin.materials.index')->with('status', 'Материал создан');
    }

    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:materials,name,' . $material->id],
        ]);

        $material->update($validated);

        return redirect()->route('admin.materials.index')->with('status', 'Материал обновлён');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('admin.materials.index')->with('status', 'Материал удалён');
    }
}




