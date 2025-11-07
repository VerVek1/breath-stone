@extends('layouts.app')
@section('title','Редактировать категорию | Admin')
@section('content')
@include('partials.header')
<main class="container" style="padding: 40px 24px;">
  <h1>Редактировать категорию</h1>
  <form method="post" action="{{ route('admin.categories.update', $category) }}" class="contact-form" style="max-width:640px;">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label>Название</label>
      <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
      @error('name')<div class="admin-auth-alert">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label>Slug</label>
      <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" required>
      @error('slug')<div class="admin-auth-alert">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label>Родитель</label>
      <select name="parent_id">
        <option value="">— Нет —</option>
        @foreach($parents as $p)
          <option value="{{ $p->id }}" @selected(old('parent_id', $category->parent_id)==$p->id)>{{ $p->name }}</option>
        @endforeach
      </select>
      @error('parent_id')<div class="admin-auth-alert">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label>Порядок</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}">
    </div>
    <button class="btn" type="submit">Сохранить</button>
    <a class="header-btn" href="{{ route('admin.categories.index') }}">Отмена</a>
  </form>
</main>

@endsection





