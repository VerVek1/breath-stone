<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Material;
use App\Models\Stone;
use Illuminate\Http\Request;
use App\Models\StoneThickness;
use Illuminate\Support\Facades\Storage;

class StoneController extends Controller
{
    public function index(Request $request)
    {
        $query = Stone::with(['material', 'manufacturer', 'thicknesses']);
        
        // Фильтр по материалу
        if ($request->filled('material_id')) {
            $query->where('material_id', $request->material_id);
        }
        
        // Фильтр по производителю
        if ($request->filled('manufacturer_id')) {
            $query->where('manufacturer_id', $request->manufacturer_id);
        }
        
        // Фильтр по цвету
        if ($request->filled('color')) {
            $query->where('color', 'like', '%' . $request->color . '%');
        }
        
        // Фильтр по текстуре
        if ($request->filled('texture')) {
            $query->where('texture', 'like', '%' . $request->texture . '%');
        }
        
        // Поиск по названию, артикулу или описанию
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Сортировка
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['id', 'name', 'sku', 'color', 'texture', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('id', 'desc');
        }
        
        $stones = $query->paginate(20)->appends($request->query());
        
        // Получаем данные для фильтров
        $materials = Material::orderBy('name')->pluck('name', 'id');
        $manufacturers = Manufacturer::orderBy('name')->pluck('name', 'id');
        
        // Статистика
        $stats = [
            'total' => Stone::count(),
            'with_material' => Stone::whereNotNull('material_id')->count(),
            'with_manufacturer' => Stone::whereNotNull('manufacturer_id')->count(),
            'with_photo' => Stone::whereNotNull('photo_path')->count(),
        ];
        
        return view('admin.stones.index', compact('stones', 'materials', 'manufacturers', 'stats'));
    }

    public function create()
    {
        $materials = Material::orderBy('name')->pluck('name', 'id');
        $manufacturers = Manufacturer::orderBy('name')->pluck('name', 'id');
        return view('admin.stones.create', compact('materials', 'manufacturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:stones,slug'],
            'sku' => ['required', 'string', 'max:255', 'unique:stones,sku'],
            'material_id' => ['nullable', 'exists:materials,id'],
            'manufacturer_id' => ['nullable', 'exists:manufacturers,id'],
            'thicknesses' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'texture' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:4096'],
        ]);

        $data = collect($validated)->except(['thicknesses', 'photo'])->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('stones', 'public');
            $data['photo_path'] = $path;
        }

        $stone = Stone::create($data);

        $this->syncThicknesses($stone, $request->input('thicknesses'));

        return redirect()->route('admin.stones.index')->with('status', 'Камень создан');
    }

    public function edit(Stone $stone)
    {
        $materials = Material::orderBy('name')->pluck('name', 'id');
        $manufacturers = Manufacturer::orderBy('name')->pluck('name', 'id');
        return view('admin.stones.edit', compact('stone', 'materials', 'manufacturers'));
    }

    public function update(Request $request, Stone $stone)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:stones,slug,' . $stone->id],
            'sku' => ['required', 'string', 'max:255', 'unique:stones,sku,' . $stone->id],
            'material_id' => ['nullable', 'exists:materials,id'],
            'manufacturer_id' => ['nullable', 'exists:manufacturers,id'],
            'thicknesses' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'texture' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:4096'],
        ]);

        $data = collect($validated)->except(['thicknesses', 'photo'])->all();

        if ($request->hasFile('photo')) {
            if ($stone->photo_path && Storage::disk('public')->exists($stone->photo_path)) {
                Storage::disk('public')->delete($stone->photo_path);
            }
            $path = $request->file('photo')->store('stones', 'public');
            $data['photo_path'] = $path;
        }

        $stone->update($data);
        $this->syncThicknesses($stone, $request->input('thicknesses'));

        return redirect()->route('admin.stones.index')->with('status', 'Камень обновлён');
    }

    public function destroy(Stone $stone)
    {
        if ($stone->photo_path && Storage::disk('public')->exists($stone->photo_path)) {
            Storage::disk('public')->delete($stone->photo_path);
        }
        $stone->delete();
        return redirect()->route('admin.stones.index')->with('status', 'Камень удалён');
    }

    private function syncThicknesses(Stone $stone, ?string $thicknessesInput): void
    {
        $stone->thicknesses()->delete();
        if (! $thicknessesInput) {
            return;
        }

        $values = collect(explode(',', $thicknessesInput))
            ->map(fn ($v) => trim(str_replace(['мм', 'MM', 'mm', 'ММ'], '', $v)))
            ->filter(fn ($v) => $v !== '')
            ->map(fn ($v) => (float) str_replace(',', '.', $v))
            ->filter(fn ($v) => $v > 0)
            ->unique()
            ->values();

        foreach ($values as $val) {
            $stone->thicknesses()->create(['thickness_mm' => $val]);
        }
    }
}


