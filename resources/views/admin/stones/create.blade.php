@extends('layouts.app')

@section('content')
<div class="container" style="padding:24px 0 48px 0; max-width:820px;">
    <h1 style="margin:0 0 16px 0;">Новый камень</h1>
    <form method="POST" action="{{ route('admin.stones.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Название</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">URL (slug)</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Автоматически генерируется из названия" style="width:100%; padding:10px; border-radius:8px; background:#333; border:1px solid #2a2a2a; color:#888;" readonly>
            @error('slug')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Артикул</label>
            <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;" required>
            @error('sku')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Материал</label>
            <select name="material_id" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;">
                <option value="">— не выбрано —</option>
                @foreach($materials as $id => $name)
                    <option value="{{ $id }}" @selected(old('material_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
            @error('material_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Производитель</label>
            <select name="manufacturer_id" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;">
                <option value="">— не выбрано —</option>
                @foreach($manufacturers as $id => $name)
                    <option value="{{ $id }}" @selected(old('manufacturer_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
            @error('manufacturer_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Толщины (через запятую)</label>
            <input type="text" name="thicknesses" value="{{ old('thicknesses') }}" class="form-control" placeholder="12 мм, 20 мм, 30 мм" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;">
            @error('thicknesses')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Цвет</label>
            <input type="text" name="color" value="{{ old('color') }}" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;">
            @error('color')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Текстура</label>
            <input type="text" name="texture" value="{{ old('texture') }}" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;">
            @error('texture')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Описание</label>
            <textarea name="description" rows="4" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;">{{ old('description') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Фото</label>
            <input type="file" name="photo" class="form-control" accept="image/*" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;">
            @error('photo')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div style="display:flex; gap:10px;">
            <button class="btn btn-primary" style="padding:10px 14px; border-radius:8px; background:#2a62ff; color:#fff;">Сохранить</button>
            <a href="{{ route('admin.stones.index') }}" class="btn btn-link" style="padding:10px 14px; border-radius:8px;">Отмена</a>
        </div>
    </form>
</div>
@endsection


