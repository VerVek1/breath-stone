@extends('layouts.app')

@section('content')
<div class="container admin-container">
    <div class="admin-actions">
        <h1 style="margin:0;">Материалы</h1>
        <a href="{{ route('admin.materials.create') }}" class="btn btn-primary">Добавить</a>
    </div>
    @if(session('status'))
        <div class="alert alert-success" style="margin-top:10px;">{{ session('status') }}</div>
    @endif
    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->name }}</td>
                    <td class="cell-actions">
                        <a href="{{ route('admin.materials.edit', $material) }}" class="btn btn-secondary">Редактировать</a>
                        <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" style="display:inline-block; margin-left:6px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $materials->links() }}
 </div>
@endsection


