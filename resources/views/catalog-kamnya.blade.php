@extends('layouts.app')
@section('title','Каталог камня | Breath Stone')
@section('meta')
<meta name="description" content="Каталог искусственного камня в Москве и Московской области: материалы, цвета, текстуры и толщины. Подбор и изготовление под заказ, доставка и монтаж.">
@php
  $canonical = $stones->currentPage() > 1 ? request()->url().'?page='.$stones->currentPage() : request()->url();
  $prev = $stones->previousPageUrl();
  $next = $stones->nextPageUrl();
@endphp
<link rel="canonical" href="{{ $canonical }}">
@if($prev)
<link rel="prev" href="{{ $prev }}">
@endif
@if($next)
<link rel="next" href="{{ $next }}">
@endif
@endsection
 
@section('content')
@include('partials.header')
<main class="container" style="padding: 40px 24px; min-height: calc(100vh - 360px);">
    <h1>Каталог камня</h1>
    <style>
      .catalog-layout { display: grid; grid-template-columns: 200px 1fr; gap: 20px; align-items: start; }
      .catalog-sidebar { position: sticky; top: 16px; align-self: start; margin-top: 40px; }
      .catalog-sidebar .filter-section {
        background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 20px;
        backdrop-filter: blur(10px);
      }
      .catalog-sidebar h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 20px 0;
        text-align: center;
      }
      .catalog-sidebar select {
        font-size: 0.9rem;
        transition: all 0.2s ease;
      }
      .catalog-sidebar select:focus {
        outline: none;
        border-color: #fff;
        box-shadow: 0 0 0 2px rgba(255,255,255,0.2);
      }
      .catalog-sidebar .btn {
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
      }
      .catalog-sidebar .btn:hover {
        transform: translateY(-1px);
      }
      /* Pagination styles */
      .catalog-pagination { gap:8px; flex-wrap:wrap; }
      .catalog-pagination .pg-btn,
      .catalog-pagination .pg-num {
        padding:8px 12px; border-radius:10px; border:1px solid rgba(255,255,255,0.15);
        background:rgba(255,255,255,0.06); color:inherit; text-decoration:none;
      }
      .catalog-pagination .pg-current {
        border-color: rgba(255,255,255,0.35);
        background: rgba(255,255,255,0.18);
      }
      .catalog-pagination .pg-ellipsis { padding:8px 6px; opacity: .8; }
      .catalog-pagination .is-disabled { pointer-events:none; opacity:.5; }
      body.light .catalog-sidebar .filter-section {
        background: #ffffff;
        border: 1px solid #e6e7eb;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      }
      body.light .catalog-sidebar h3 {
        color: #111827;
      }
      body.light .catalog-sidebar select {
        background: #ffffff !important;
        border: 1px solid #d1d5db !important;
        color: #374151 !important;
      }
      body.light .catalog-sidebar select:focus {
        border-color: #111827 !important;
        box-shadow: 0 0 0 2px rgba(17,24,39,0.1) !important;
      }
      body.light .catalog-sidebar .btn.btn-secondary,
      body.light .catalog-sidebar .btn.btn-primary {
        background: #111 !important;
        color: #fff !important;
        border: 1px solid #111 !important;
      }
      @media (max-width: 900px) {
        .catalog-layout { grid-template-columns: 1fr; gap: 16px; }
        .catalog-sidebar { position: static; margin-top: 0; }
        .catalog-sidebar .filter-section {
          margin-bottom: 20px;
        }
        .catalog-sidebar .filter-buttons {
          gap: 8px;
        }
        .catalog-sidebar select {
          font-size: 0.85rem;
          padding: 8px 10px;
        }
        .catalog-sidebar .btn {
          font-size: 0.85rem;
          padding: 10px 14px;
        }
      }
      @media (max-width: 385px) {
        .catalog-sidebar .filter-section {
          
          margin: 0 -8px 16px -8px;
        }
        .catalog-sidebar h3 {
          font-size: 1.1rem;
          margin-bottom: 16px;
        }
        .catalog-sidebar select {
          font-size: 0.8rem;
          padding: 6px 8px;
        }
        .catalog-sidebar .btn {
          font-size: 0.8rem;
          padding: 8px 12px;
        }
        .catalog-sidebar .filter-actions {
          gap: 8px;
          padding: 0 4px;
        }
      }
       @media (max-width: 335px) {
           .catalog-sidebar .filter-section {
          width:76vw;
          margin: 0 -8px 16px -8px;
        }
        body.light .catalog-sidebar .filter-section {
             width:76vw;
        }
       }
    </style>

    <div class="catalog-layout">
      <aside class="catalog-sidebar" aria-label="Фильтр каталога">
        <div class="filter-section">
          <div class="filter-container" style="max-width:100%;margin:0;">
            <h3 style="margin:0 0 14px 0;">Фильтры</h3>
            <div class="filter-buttons" style="display:flex; flex-direction:column; gap:10px; align-items: stretch;">
                        @php
                          $materials = $stones->pluck('material.name')->filter()->unique()->values();
                          $manufacturers = $stones->pluck('manufacturer.name')->filter()->unique()->values();
                          $colors = $stones->pluck('color')->filter()->unique()->values();
                          $textures = $stones->pluck('texture')->filter()->unique()->values();
                          $thicknesses = $stones->pluck('thicknesses')->flatten()->pluck('thickness_mm')->filter()->unique()->sort()->values();
                        @endphp
                        <select id="filterMaterial" aria-label="Фильтр по материалу" style="width:100%; box-sizing:border-box; padding:10px 12px; border-radius:10px; border:1px solid #333; background:var(--bs-input-bg,#222); color:inherit;">
                            <option value="">Материал: все</option>
                            @foreach($materials as $m)
                              <option value="{{ \Illuminate\Support\Str::lower($m) }}">{{ $m }}</option>
                            @endforeach
                        </select>
                        <select id="filterManufacturer" aria-label="Фильтр по производителю" style="width:100%; box-sizing:border-box; padding:10px 12px; border-radius:10px; border:1px solid #333; background:var(--bs-input-bg,#222); color:inherit;">
                            <option value="">Производитель: все</option>
                            @foreach($manufacturers as $v)
                              <option value="{{ \Illuminate\Support\Str::lower($v) }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <select id="filterColor" aria-label="Фильтр по цвету" style="width:100%; box-sizing:border-box; padding:10px 12px; border-radius:10px; border:1px solid #333; background:var(--bs-input-bg,#222); color:inherit;">
                            <option value="">Цвет: все</option>
                            @foreach($colors as $c)
                              <option value="{{ \Illuminate\Support\Str::lower($c) }}">{{ $c }}</option>
                            @endforeach
                        </select>
                        <select id="filterTexture" aria-label="Фильтр по текстуре" style="width:100%; box-sizing:border-box; padding:10px 12px; border-radius:10px; border:1px solid #333; background:var(--bs-input-bg,#222); color:inherit;">
                            <option value="">Текстура: все</option>
                            @foreach($textures as $t)
                              <option value="{{ \Illuminate\Support\Str::lower($t) }}">{{ $t }}</option>
                            @endforeach
                        </select>
                        <select id="filterThickness" aria-label="Фильтр по толщине" style="width:100%; box-sizing:border-box; padding:10px 12px; border-radius:10px; border:1px solid #333; background:var(--bs-input-bg,#222); color:inherit;">
                            <option value="">Толщина: все</option>
                            @foreach($thicknesses as $mm)
                              <option value="{{ (int)$mm }}">{{ rtrim(rtrim(number_format($mm, 2, ',', ' '), '0'), ',') }} мм</option>
                            @endforeach
                        </select>
                        <div class="filter-actions" style="display:flex; flex-direction:column; justify-content:space-between; gap:12px; width:100%; padding:0 8px; box-sizing:border-box;">
                          <button id="applyFilters" type="button" class="btn btn-primary" style="padding:12px 16px;border-radius:12px; width:100%;">Применить</button>
                          <button id="resetFilters" type="button" class="btn btn-secondary" style="padding:12px 16px;border-radius:12px; width:100%;">Сбросить</button>
                        </div>
            </div>
          </div>
        </div>
      </aside>

      <section class="catalog-content">
        <div class="catalog-grid catalog-tiles">
        <div class="catalog-empty" style="display:none; grid-column: 1 / -1; padding: 24px; border: 1px dashed rgba(255,255,255,0.2); border-radius: 12px; text-align: center; color: #9ca3af;">
          Ничего не найдено по текущим фильтрам. Измените параметры и попробуйте снова.
        </div>
        @foreach($stones as $stone)
        @php
            $photoUrl = null;
            if ($stone->photo_path) {
                $exists = \Illuminate\Support\Facades\Storage::disk('public')->exists($stone->photo_path);
                if ($exists) {
                    $photoUrl = \Illuminate\Support\Facades\Storage::url($stone->photo_path);
                }
            }
        @endphp
        <a href="{{ route('catalog.stones.show', $stone) }}" class="catalog-tile" 
           data-material="{{ \Illuminate\Support\Str::lower(optional($stone->material)->name) }}"
           data-manufacturer="{{ \Illuminate\Support\Str::lower(optional($stone->manufacturer)->name) }}"
           data-color="{{ \Illuminate\Support\Str::lower($stone->color) }}"
           data-texture="{{ \Illuminate\Support\Str::lower($stone->texture) }}"
           data-thicknesses="{{ $stone->thicknesses->pluck('thickness_mm')->map(fn($v)=>(int)$v)->implode(',') }}">
           <img class="thumb" src="{{ $photoUrl ?: 'https://via.placeholder.com/600x400?text=Stone' }}" alt="{{ $stone->name }}" loading="lazy" width="600" height="400">
            <div class="meta">
                <h3>{{ $stone->name }}</h3>
                <p>{{ $stone->description ? \Illuminate\Support\Str::limit($stone->description, 90) : (optional($stone->material)->name ?: '') }}</p>
                <div class="tags">
                    @if(optional($stone->material)->name)
                        <span class="tag">{{ optional($stone->material)->name }}</span>
                    @endif
                    @if($stone->color)
                        <span class="tag">{{ $stone->color }}</span>
                    @endif
                </div>
                <div class="actions"><span class="btn-more">Подробнее</span></div>
            </div>
        </a>
        @endforeach
        </div>
        @if ($stones->hasPages())
        <nav class="catalog-pagination" aria-label="Навигация по страницам" style="margin:24px 0; display:flex; justify-content:center;">
          @php
            $current = $stones->currentPage();
            $last = $stones->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $current + 2);
          @endphp
          <a href="{{ $stones->previousPageUrl() ?: '#' }}" aria-label="Предыдущая страница" class="pg-btn {{ $stones->onFirstPage() ? 'is-disabled' : '' }}">«</a>

          @if ($start > 1)
            <a href="{{ $stones->url(1) }}" class="pg-num">1</a>
            @if ($start > 2)
              <span aria-hidden="true" class="pg-ellipsis">…</span>
            @endif
          @endif

          @for ($page = $start; $page <= $end; $page++)
            @if ($page == $current)
              <span aria-current="page" class="pg-num pg-current">{{ $page }}</span>
            @else
              <a href="{{ $stones->url($page) }}" class="pg-num">{{ $page }}</a>
            @endif
          @endfor

          @if ($end < $last)
            @if ($end < $last - 1)
              <span aria-hidden="true" class="pg-ellipsis">…</span>
            @endif
            <a href="{{ $stones->url($last) }}" class="pg-num">{{ $last }}</a>
          @endif

          <a href="{{ $stones->nextPageUrl() ?: '#' }}" aria-label="Следующая страница" class="pg-btn {{ $current >= $last ? 'is-disabled' : '' }}">»</a>
        </nav>
        @endif
        
      </section>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var grid = document.querySelector('.catalog-content .catalog-grid.catalog-tiles');
        if (!grid) return;
        var mainEl = document.querySelector('main.container');
        var baseMinHeight = mainEl ? mainEl.style.minHeight : '';
        var tiles = Array.prototype.slice.call(grid.querySelectorAll('.catalog-tile'));
        var empty = grid.querySelector('.catalog-empty');
        var fMat = document.getElementById('filterMaterial');
        var fMan = document.getElementById('filterManufacturer');
        var fCol = document.getElementById('filterColor');
        var fTex = document.getElementById('filterTexture');
        var fThk = document.getElementById('filterThickness');
        function normalize(str){ return (str || '').toLowerCase().replace(/ё/g,'е'); }
        function updateEmptyState(){
            var anyVisible = tiles.some(function(tile){ return tile.style.display !== 'none'; });
            if (empty) empty.style.display = anyVisible ? 'none' : '';
            if (mainEl) {
                if (!anyVisible) {
                    // Когда нет карточек — растягиваем основной блок, чтобы футер был у низа
                    mainEl.style.minHeight = 'calc(100vh - 120px)';
                } else {
                    mainEl.style.minHeight = baseMinHeight;
                }
            }
        }
        function applyFilters(){
            var mat = normalize(fMat ? fMat.value : '');
            var man = normalize(fMan ? fMan.value : '');
            var col = normalize(fCol ? fCol.value : '');
            var tex = normalize(fTex ? fTex.value : '');
            var thk = (fThk && fThk.value) ? parseInt(fThk.value, 10) : '';
            tiles.forEach(function(tile){
                var okMat = !mat || normalize(tile.dataset.material) === mat;
                var okMan = !man || normalize(tile.dataset.manufacturer) === man;
                var okCol = !col || normalize(tile.dataset.color) === col;
                var okTex = !tex || normalize(tile.dataset.texture) === tex;
                var okThk = true;
                if (thk !== '') {
                    var list = (tile.dataset.thicknesses || '').split(',').map(function(v){ return parseInt(v,10); }).filter(function(v){ return !isNaN(v); });
                    okThk = list.indexOf(thk) !== -1;
                }
                tile.style.display = (okMat && okMan && okCol && okTex && okThk) ? '' : 'none';
            });
            updateEmptyState();
        }
        var applyBtn = document.getElementById('applyFilters');
        var resetBtn = document.getElementById('resetFilters');
        if (applyBtn) {
            applyBtn.addEventListener('click', applyFilters);
        }
        if (resetBtn) {
            resetBtn.addEventListener('click', function(){
                if (fMat) fMat.value = '';
                if (fMan) fMan.value = '';
                if (fCol) fCol.value = '';
                if (fTex) fTex.value = '';
                if (fThk) fThk.value = '';
                applyFilters();
            });
        }
        // Если карточек нет вовсе (пустая страница) — покажем сообщение
        if (tiles.length === 0) {
            if (empty) empty.style.display = '';
            if (mainEl) mainEl.style.minHeight = 'calc(100vh - 120px)';
            return;
        }
        applyFilters();
    });
    </script>
</main>
@endsection




