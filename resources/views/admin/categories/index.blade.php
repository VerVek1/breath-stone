@extends('layouts.app')
@section('title','Категории | Admin')
@section('content')
@include('partials.header')
<main class="container" style="padding: 40px 24px;">
  <h1>Категории</h1>
  @if(session('success'))
    <div class="admin-auth-alert">{{ session('success') }}</div>
  @endif
  <p><a class="btn" href="{{ route('admin.categories.create') }}">Добавить категорию</a></p>

  <table class="materials-table" style="margin-top:16px;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Slug</th>
        <th>Родитель</th>
        <th>Порядок</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $cat)
        <tr>
          <td>{{ $cat->id }}</td>
          <td>{{ $cat->name }}</td>
          <td>{{ $cat->slug }}</td>
          <td>{{ optional($cat->parent)->name }}</td>
          <td>{{ $cat->sort_order }}</td>
          <td>
            <a href="{{ route('admin.categories.edit', $cat) }}">Редактировать</a>
            <form action="{{ route('admin.categories.destroy', $cat) }}" method="post" style="display:inline-block" onsubmit="return confirm('Удалить категорию?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="header-btn" style="padding:6px 12px;">Удалить</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</main>

@endsection





