@extends('layouts.app')

@section('title', 'Вход в админ-панель')

@section('content')
  <header>@include('partials.header')</header>
  <main class="container" style="padding:48px 0; max-width:560px;">
    <h1 style="margin:0 0 16px 0;">Вход в админ-панель</h1>
    <p style="opacity:.8; margin:0 0 20px 0;">Введите пароль администратора.</p>

    @if ($errors->any())
      <div class="admin-auth-alert">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="admin-auth-card card">
      <form method="POST" action="{{ route('admin.login.post') }}" style="display:grid; gap:12px;">
        @csrf
        <label class="form-field" style="display:grid; gap:6px;">
          <span>Пароль</span>
          <input type="password" name="password" required>
        </label>
        <button type="submit" class="btn" style="justify-self:start;">Войти</button>
      </form>
    </div>
  </main>
  
@endsection


