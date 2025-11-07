@extends('layouts.app')
@section('title','Редактировать товар | Admin')
@section('content')
@include('partials.header')
<main class="container" style="padding: 40px 24px;">
  <h1>Редактировать товар</h1>
  <form method="post" action="{{ route('admin.products.update', $product) }}" class="contact-form" style="max-width:860px;">
    @csrf
    @method('PUT')
    <div class="form-group"><label>Название</label><input type="text" name="name" value="{{ old('name', $product->name) }}" required></div>
    <div class="form-group"><label>Slug</label><input type="text" name="slug" value="{{ old('slug', $product->slug) }}" required></div>
    <div class="form-group"><label>SKU</label><input type="text" name="sku" value="{{ old('sku', $product->sku) }}"></div>
    <div class="form-group"><label>Материал</label><input type="text" name="material_type" value="{{ old('material_type', $product->material_type) }}" required></div>
    <div class="form-group"><label>Толщина (мм)</label><input type="number" name="thickness_mm" value="{{ old('thickness_mm', $product->thickness_mm) }}" min="0"></div>
    <div class="form-group"><label>Бренд</label><input type="text" name="brand" value="{{ old('brand', $product->brand) }}"></div>
    <div class="form-group"><label>Страна</label><input type="text" name="country" value="{{ old('country', $product->country) }}"></div>
    <div class="form-group"><label>Цвет</label><input type="text" name="color" value="{{ old('color', $product->color) }}"></div>
    <div class="form-group"><label>Текстура</label><input type="text" name="texture" value="{{ old('texture', $product->texture) }}"></div>
    <div class="form-group"><label>Цена за м²</label><input type="number" step="0.01" min="0" name="price_per_m2" value="{{ old('price_per_m2', $product->price_per_m2) }}"></div>
    <div class="form-group"><label>Короткое описание</label><textarea name="short_description">{{ old('short_description', $product->short_description) }}</textarea></div>
    <div class="form-group"><label>Описание</label><textarea name="description" rows="6">{{ old('description', $product->description) }}</textarea></div>
    <div class="form-group"><label>Опубликован</label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}></div>
    <div class="form-group">
      <label>Категории</label>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:8px;">
        @foreach($categories as $c)
          <label style="display:flex;align-items:center;gap:8px;"><input type="checkbox" name="category_ids[]" value="{{ $c->id }}" @checked(in_array($c->id, $selected))> {{ $c->name }}</label>
        @endforeach
      </div>
    </div>
    <div class="form-group"><label>Meta title</label><input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}"></div>
    <div class="form-group"><label>Meta description</label><textarea name="meta_description">{{ old('meta_description', $product->meta_description) }}</textarea></div>
    <div class="form-group"><label>Meta keywords</label><textarea name="meta_keywords">{{ old('meta_keywords', $product->meta_keywords) }}</textarea></div>
    <button class="btn" type="submit">Сохранить</button>
    <a class="header-btn" href="{{ route('admin.products.index') }}">Отмена</a>
  </form>
</main>

@endsection





