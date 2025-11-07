@extends('layouts.app')
@section('title','Товары | Admin')
@section('content')
@include('partials.header')
<main class="container" style="padding: 40px 24px;">
  <h1>Товары</h1>
  @if(session('success'))
    <div class="admin-auth-alert">{{ session('success') }}</div>
  @endif
  <p>
    <a class="btn" href="{{ route('admin.products.create') }}">Добавить товар</a>
    <a class="header-btn" href="{{ route('admin.categories.index') }}">Категории</a>
  </p>

  <table class="materials-table" style="margin-top:16px;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Название</th>
        <th>SKU</th>
        <th>Цена/м²</th>
        <th>Категории</th>
        <th>Опубликован</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ $p->sku }}</td>
          <td>{{ $p->price_per_m2 }}</td>
          <td>{{ $p->categories->pluck('name')->join(', ') }}</td>
          <td>{{ $p->is_active ? 'да' : 'нет' }}</td>
          <td>
            <a href="{{ route('admin.products.edit', $p) }}">Редактировать</a>
            <form action="{{ route('admin.products.destroy', $p) }}" method="post" style="display:inline-block" onsubmit="return confirm('Удалить товар?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="header-btn" style="padding:6px 12px;">Удалить</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div style="margin-top:12px;">{{ $products->links() }}</div>
</main>

@endsection





