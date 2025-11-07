@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
<header>
    @include('partials.header')
  </header>
  <main class="container" style="padding:24px 0 48px 0;">
    <h1 style="margin:0 0 16px 0;">Админ-панель</h1>
    <p style="opacity:.8; margin:0 0 24px 0;">Добро пожаловать! Здесь появятся инструменты управления сайтом.</p>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:16px;">
      <a href="{{ route('admin.materials.index') }}" class="card" style="display:block; background:#1e1e1e; border:1px solid #2a2a2a; border-radius:12px; padding:16px; text-decoration:none; color:inherit;">
        <h3 style="margin:0 0 8px 0;">Материалы</h3>
        <p style="opacity:.8; margin:0;">Справочник материалов.</p>
      </a>
      <a href="{{ route('admin.manufacturers.index') }}" class="card" style="display:block; background:#1e1e1e; border:1px solid #2a2a2a; border-radius:12px; padding:16px; text-decoration:none; color:inherit;">
        <h3 style="margin:0 0 8px 0;">Производители</h3>
        <p style="opacity:.8; margin:0;">Справочник производителей.</p>
      </a>
      <a href="{{ route('admin.stones.index') }}" class="card" style="display:block; background:#1e1e1e; border:1px solid #2a2a2a; border-radius:12px; padding:16px; text-decoration:none; color:inherit;">
        <h3 style="margin:0 0 8px 0;">Камни</h3>
        <p style="opacity:.8; margin:0;">Каталог камней.</p>
      </a>
      <a href="{{ route('admin.applications.index') }}" class="card" style="display:block; background:#1e1e1e; border:1px solid #2a2a2a; border-radius:12px; padding:16px; text-decoration:none; color:inherit;">
        <h3 style="margin:0 0 8px 0;">Заявки</h3>
        <p style="opacity:.8; margin:0;">Просмотр входящих заявок с форм.</p>
      </a>
      <a href="#" class="card" style="display:block; background:#1e1e1e; border:1px solid #2a2a2a; border-radius:12px; padding:16px; text-decoration:none; color:inherit;">
        <h3 style="margin:0 0 8px 0;">Настройки</h3>
        <p style="opacity:.8; margin:0;">Базовые параметры сайта.</p>
      </a>
    </div>
  </main>
  
@endsection


