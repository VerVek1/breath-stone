@extends('layouts.app')

@section('content')
<div class="container admin-container">
    <div class="admin-actions">
        <h1 style="margin:0;">Производители</h1>
        <a href="{{ route('admin.manufacturers.create') }}" class="btn btn-primary">Добавить</a>
    </div>
    @if(session('status'))
        <div class="alert alert-success" style="margin-top:10px;">{{ session('status') }}</div>
    @endif
    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Страна</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($manufacturers as $manufacturer)
                <tr>
                    <td>{{ $manufacturer->id }}</td>
                    <td>{{ $manufacturer->name }}</td>
                    <td>{{ $manufacturer->country }}</td>
                    <td class="cell-actions">
                        <a href="{{ route('admin.manufacturers.edit', $manufacturer) }}" class="btn btn-secondary">Редактировать</a>
                        <form action="{{ route('admin.manufacturers.destroy', $manufacturer) }}" method="POST" style="display:inline-block; margin-left:6px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $manufacturers->links() }}
 </div>
@endsection


