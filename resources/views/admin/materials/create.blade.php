@extends('layouts.app')

@section('content')
<div class="container" style="padding:24px 0 48px 0; max-width:720px;">
    <h1 style="margin:0 0 16px 0;">Новый материал</h1>
    <form method="POST" action="{{ route('admin.materials.store') }}">
        @csrf
        <div class="mb-3" style="margin-bottom:12px;">
            <label class="form-label" style="display:block; margin-bottom:6px;">Название</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" style="width:100%; padding:10px; border-radius:8px; background:#111; border:1px solid #2a2a2a; color:#fff;" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div style="display:flex; gap:10px;">
            <button class="btn btn-primary" style="padding:10px 14px; border-radius:8px; background:#2a62ff; color:#fff;">Сохранить</button>
            <a href="{{ route('admin.materials.index') }}" class="btn btn-link" style="padding:10px 14px; border-radius:8px;">Отмена</a>
        </div>
    </form>
</div>
@endsection


