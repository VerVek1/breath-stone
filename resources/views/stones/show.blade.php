@extends('layouts.app')
@section('title', $stone->name . ' | Каталог')
@section('meta')
@php
  $metaDesc = trim(implode(' ', array_filter([
    $stone->name,
    optional($stone->material)->name ? ('материал: '.optional($stone->material)->name) : null,
    $stone->color ? ('цвет: '.$stone->color) : null,
    $stone->texture ? ('текстура: '.$stone->texture) : null,
    'изготовление и монтаж в Москве и Московской области',
  ])));
@endphp
<meta name="description" content="{{ \Illuminate\Support\Str::limit($metaDesc, 160, '') }}">
<link rel="canonical" href="{{ url()->current() }}">
@endsection
 
@section('content')
@include('partials.header')

<style>
.stone-detail {
  background: linear-gradient(135deg, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0.01) 100%);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 20px;
  padding: 40px;
  margin: 40px 0;
  backdrop-filter: blur(10px);
}
.stone-back-link {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 12px 20px;
  background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: 25px;
  color: #111;
  text-decoration: none;
  font-size: 0.95rem;
  font-weight: 600;
  transition: all 0.3s ease;
  margin-bottom: 24px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
.stone-back-link:hover {
  background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
  border-color: rgba(255,255,255,0.3);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}
.stone-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: start;
}
.stone-image {
  width: 100%;
  height: auto;
  max-height: 390px;
  object-fit: cover;
  border-radius: 16px;
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 12px 32px rgba(0,0,0,0.3);
  transition: transform 0.3s ease;
}
.stone-image:hover {
  transform: scale(1.02);
}
.stone-info h1 {
  margin: 0 0 12px 0;
  font-size: 2.2rem;
  font-weight: 800;
  line-height: 1.2;
  background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.stone-sku {
  opacity: 0.8;
  margin: 0 0 20px 0;
  font-size: 1rem;
  color: #bbb;
}
.stone-tags {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin: 16px 0 24px 0;
}
.stone-tag {
  padding: 8px 14px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
  color: #fff;
  backdrop-filter: blur(10px);
}
.stone-detail-section {
  margin: 20px 0;
  padding: 16px 0;
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
.stone-detail-section:last-child {
  border-bottom: none;
}
.stone-detail-section h3 {
  margin: 0 0 8px 0;
  font-size: 1.1rem;
  font-weight: 700;
  color: #fff;
}
.stone-detail-section p {
  margin: 0;
  line-height: 1.6;
  color: #bbb;
}
.stone-description {
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 12px;
  padding: 20px;
  margin-top: 16px;
}
.stone-description h3 {
  margin: 0 0 12px 0;
  font-size: 1.2rem;
  font-weight: 700;
  color: #fff;
}
.stone-description p {
  margin: 0;
  line-height: 1.7;
  color: #ddd;
}

/* Light theme */
body.light .stone-detail {
  background: #ffffff;
  border: 1px solid #e6e7eb;
  box-shadow: 0 8px 24px rgba(0,0,0,0.06);
}
body.light .stone-back-link {
  background: linear-gradient(135deg, #111 0%, #333 100%);
  border: 1px solid #111;
  color: #fff;
  box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}
body.light .stone-back-link:hover {
  background: linear-gradient(135deg, #222 0%, #444 100%);
  border-color: #222;
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}
body.light .stone-image {
  border: 1px solid #e6e7eb;
  box-shadow: 0 8px 24px rgba(0,0,0,0.1);
}
body.light .stone-info h1 {
  background: none;
  -webkit-text-fill-color: initial;
  color: #111827;
}
body.light .stone-sku {
  color: #6b7280;
}
body.light .stone-tag {
  background: #f3f4f6;
  border: 1px solid #e5e7eb;
  color: #374151;
}
body.light .stone-detail-section h3 {
  color: #111827;
}
body.light .stone-detail-section p {
  color: #6b7280;
}
body.light .stone-description {
  background: #f9fafb;
  border: 1px solid #e5e7eb;
}
body.light .stone-description h3 {
  color: #111827;
}
body.light .stone-description p {
  color: #374151;
}

/* Стили для информационного блока о мойках из акрилового камня */
.acrylic-sink-info {
  margin-top: 20px;
  padding: 15px;
  background: rgba(255,255,255,0.05);
  border-radius: 10px;
  border-left: 4px solid #4a9eff;
}

.acrylic-sink-info p {
  margin: 0 0 10px 0;
  color: #ccc;
  font-size: 0.9rem;
  line-height: 1.5;
}

.acrylic-sink-info p:last-child {
  margin: 0;
}

/* Стили для светлой темы */
body.light .acrylic-sink-info {
  background: rgba(59, 130, 246, 0.05);
  border-left: 4px solid #3b82f6;
}

body.light .acrylic-sink-info p {
  color: #374151;
}

/* Стили для кнопки стоимости услуг */
.pricing-section {
  margin-top: 20px;
}

.pricing-btn {
  background: #fff;
  color: #111;
  border: none;
  border-radius: 24px;
  padding: 10px 28px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.pricing-btn:hover {
  background: #222;
  color: #fff;
}

/* Стили для светлой темы */
body.light .pricing-btn {
  background: #111;
  color: #fff;
}

body.light .pricing-btn:hover {
  background: #333;
  color: #fff;
}

/* Стили для модальных окон */
.pricing-modal {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.8);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 10000;
  padding: 20px;
}

.pricing-modal-content {
  background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: 20px;
  padding: 30px;
  max-width: 600px;
  width: 100%;
  max-height: 80vh;
  overflow-y: auto;
  backdrop-filter: blur(15px);
  box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

/* Стилизация ползунка прокрутки */
.pricing-modal-content::-webkit-scrollbar {
  width: 8px;
}

.pricing-modal-content::-webkit-scrollbar-track {
  background: rgba(255,255,255,0.1);
  border-radius: 4px;
}

.pricing-modal-content::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #4a9eff 0%, #3b82f6 100%);
  border-radius: 4px;
  transition: all 0.3s ease;
}

.pricing-modal-content::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

/* Для Firefox */
.pricing-modal-content {
  scrollbar-width: thin;
  scrollbar-color: #4a9eff rgba(255,255,255,0.1);
}

.pricing-modal h2 {
  margin: 0 0 20px 0;
  font-size: 1.8rem;
  font-weight: 700;
  color: #fff;
  text-align: center;
}

.pricing-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.pricing-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  color: #fff;
}

.pricing-item:last-child {
  border-bottom: none;
}

.pricing-item-name {
  flex: 1;
  font-size: 0.95rem;
  line-height: 1.4;
}

.pricing-item-price {
  font-weight: 600;
  color: #4a9eff;
  font-size: 0.9rem;
  white-space: nowrap;
  margin-left: 15px;
}

.pricing-modal-close {
  position: absolute;
  top: 15px;
  right: 20px;
  background: none;
  border: none;
  color: #fff;
  font-size: 1.5rem;
  cursor: pointer;
  opacity: 0.7;
  transition: opacity 0.3s ease;
}

.pricing-modal-close:hover {
  opacity: 1;
}

/* Стили для светлой темы */
body.light .pricing-modal-content {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 1px solid #e2e8f0;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

body.light .pricing-modal h2 {
  color: #1e293b;
}

body.light .pricing-item {
  color: #374151;
  border-bottom: 1px solid #e2e8f0;
}

body.light .pricing-item-price {
  color: #1e40af;
}

body.light .pricing-modal-close {
  color: #374151;
}

/* Стилизация ползунка прокрутки для светлой темы */
body.light .pricing-modal-content::-webkit-scrollbar-track {
  background: rgba(0,0,0,0.05);
}

body.light .pricing-modal-content::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
}

body.light .pricing-modal-content::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%);
}

body.light .pricing-modal-content {
  scrollbar-color: #1e40af rgba(0,0,0,0.05);
}

/* Стили для группировки прайс-листов */
.pricing-group {
  margin-bottom: 25px;
  background: rgba(255,255,255,0.03);
  border-radius: 12px;
  padding: 20px;
  border: 1px solid rgba(255,255,255,0.08);
}

.pricing-group:last-child {
  margin-bottom: 0;
}

.pricing-group-title {
  margin: 0 0 15px 0;
  font-size: 1.1rem;
  font-weight: 700;
  color: #4a9eff;
  text-align: center;
  padding-bottom: 10px;
  border-bottom: 2px solid rgba(74, 158, 255, 0.3);
}

.pricing-group .pricing-item {
  border-bottom: 1px solid rgba(255,255,255,0.05);
}

.pricing-group .pricing-item:last-child {
  border-bottom: none;
}

/* Стили для светлой темы */
body.light .pricing-group {
  background: rgba(59, 130, 246, 0.03);
  border: 1px solid rgba(59, 130, 246, 0.1);
}

body.light .pricing-group-title {
  color: #1e40af;
  border-bottom: 2px solid rgba(30, 64, 175, 0.3);
}

body.light .pricing-group .pricing-item {
  border-bottom: 1px solid rgba(59, 130, 246, 0.1);
}

/* Стили для блока с пометкой о точном расчете */
.pricing-disclaimer {
  margin-top: 25px;
  padding: 20px;
  background: rgba(255,255,255,0.05);
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.1);
  border-left: 4px solid #4a9eff;
}

.pricing-disclaimer p {
  margin: 0;
  color: #fff;
  font-size: 0.95rem;
  line-height: 1.5;
  text-align: center;
}

.pricing-disclaimer strong {
  color: #4a9eff;
  font-weight: 700;
}

/* Стили для светлой темы */
body.light .pricing-disclaimer {
  background: rgba(59, 130, 246, 0.05);
  border: 1px solid rgba(59, 130, 246, 0.1);
  border-left: 4px solid #3b82f6;
}

body.light .pricing-disclaimer p {
  color: #374151;
}

body.light .pricing-disclaimer strong {
  color: #1e40af;
}

/* Material gallery styles */
.material-gallery {
  background: linear-gradient(135deg, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0.01) 100%);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 20px;
  backdrop-filter: blur(15px);
  box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.material-gallery h2 {
  background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.gallery-section {
  background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 16px;
  padding: 24px;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.gallery-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);
}

.gallery-section:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 40px rgba(0,0,0,0.15);
  border-color: rgba(255,255,255,0.2);
}

.gallery-section h3 {
  position: relative;
  z-index: 1;
  margin-bottom: 20px;
  font-weight: 700;
  text-align: center;
  background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.gallery-images {
  position: relative;
  z-index: 1;
}

.gallery-images img {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.gallery-images img:hover {
  transform: scale(1.08) translateY(-2px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.25);
  border-color: rgba(255,255,255,0.3);
  z-index: 10;
  position: relative;
}

/* Lightbox overlay */
.lightbox-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.85);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  padding: 20px;
}
.lightbox-overlay img {
  max-width: 95vw;
  max-height: 95vh;
  border-radius: 10px;
  box-shadow: 0 20px 60px rgba(0,0,0,0.6);
}
.lightbox-overlay .lightbox-close-hint {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  color: rgba(255,255,255,0.85);
  font-size: 0.9rem;
  background: rgba(255,255,255,0.08);
  padding: 6px 10px;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.2);
}

/* Light theme for material gallery */
body.light .material-gallery {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 1px solid #e2e8f0;
  box-shadow: 0 8px 32px rgba(0,0,0,0.08);
}

body.light .material-gallery h2 {
  background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

body.light .gallery-section {
  background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
  border: 1px solid #e2e8f0;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}

body.light .gallery-section:hover {
  box-shadow: 0 12px 40px rgba(0,0,0,0.08);
  border-color: #cbd5e1;
}

body.light .gallery-section h3 {
  background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

body.light .gallery-images img {
  border: 1px solid #e2e8f0;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
}

body.light .gallery-images img:hover {
  box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  border-color: #94a3b8;
}

@media (max-width: 768px) {
  .stone-detail {
    padding: 24px;
    margin: 20px 0;
  }
  .stone-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
  .stone-info h1 {
    font-size: 1.8rem;
  }
  
  .material-gallery {
    padding: 20px 0;
    margin: 20px 0;
    border-radius: 16px;
  }
  
  .material-gallery h2 {
    font-size: 1.5rem !important;
    margin-bottom: 20px !important;
  }
  
  .gallery-grid {
    grid-template-columns: 1fr !important;
    gap: 15px !important;
  }
  
  .gallery-section {
    padding: 16px;
    border-radius: 12px;
  }
  
  .gallery-section h3 {
    font-size: 1.1rem !important;
    margin-bottom: 15px !important;
  }
  
  .gallery-images {
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)) !important;
    gap: 8px !important;
  }
  
  .gallery-images img {
    height: 60px !important;
    border-radius: 6px !important;
  }
  
  .gallery-images img:hover {
    transform: scale(1.05) translateY(-1px) !important;
  }
}

@media (max-width: 480px) {
  .material-gallery h2 {
    font-size: 1.3rem !important;
  }
  
  .gallery-section {
    padding: 12px;
  }
  
  .gallery-section h3 {
    font-size: 1rem !important;
  }
  
  .gallery-images {
    grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)) !important;
    gap: 6px !important;
  }
  
  .gallery-images img {
    height: 50px !important;
  }
}
</style>

<main class="container">
  <div class="stone-detail">
    
    <a href="{{ route('catalog.stones') }}" class="stone-back-link">
      ← Назад в каталог
    </a>
    
    <div class="stone-grid">
      <div>
        @php
          $photoUrl = null;
          if ($stone->photo_path) {
              $exists = \Illuminate\Support\Facades\Storage::disk('public')->exists($stone->photo_path);
              if ($exists) {
                  $photoUrl = \Illuminate\Support\Facades\Storage::url($stone->photo_path);
              }
          }
        @endphp
        <img src="{{ $photoUrl ?: 'https://via.placeholder.com/800x600?text=Stone' }}" 
             alt="{{ $stone->name }}" 
             class="stone-image" loading="lazy" width="800" height="600">
      </div>
      
      <div class="stone-info">
        <h1>{{ $stone->name }}</h1>
        <div class="stone-sku">Артикул: {{ $stone->sku }}</div>
        
        @php
          $materialName = optional($stone->material)->name;
          $materialNameLc = $materialName ? mb_strtolower($materialName) : null;
          $isQuartz = $materialNameLc && (str_contains($materialNameLc, 'кварц') || str_contains($materialNameLc, 'quartz'));
          $isAcrylic = $materialNameLc && (str_contains($materialNameLc, 'акрил') || str_contains($materialNameLc, 'acrylic'));
          $normalizedMaterialLabel = $isQuartz ? 'Кварцевый камень' : ($isAcrylic ? 'Акриловый камень' : $materialName);
        @endphp

        <div class="stone-tags">
          @if($materialName)
            <span class="stone-tag">Материал: {{ $normalizedMaterialLabel }}</span>
          @endif
          @if(optional($stone->manufacturer)->name)
            <span class="stone-tag">Производитель: {{ $stone->manufacturer->name }}</span>
          @endif
          @if($stone->color)
            <span class="stone-tag">Цвет: {{ $stone->color }}</span>
          @endif
          @if($stone->texture)
            <span class="stone-tag">Текстура: {{ $stone->texture }}</span>
          @endif
        </div>
        
        @if($stone->thicknesses->count())
          <div class="stone-detail-section">
            <h3>Доступные толщины</h3>
            <p>
              {{ $stone->thicknesses->pluck('thickness_mm')->map(fn($v) => rtrim(rtrim(number_format($v, 2, ',', ' '), '0'), ',').' мм')->implode(', ') }}
            </p>
          </div>
        @endif
        
        @if($stone->description)
          <div class="stone-description">
            <h3>Описание</h3>
            <p>{!! nl2br(e($stone->description)) !!}</p>
          </div>
        @endif
        
        
        <div class="pricing-section">
          <button class="pricing-btn" onclick="openPricingModal()">
            Стоимость услуг для данного камня
          </button>
        </div>
      </div>
    </div>
  </div>
  @if(isset($relatedStones) && $relatedStones->count())
  <section class="related-stones" style="padding: 0 0 40px 0;">
    <div class="container">
      <h2 style="margin:24px 0 12px 0;">Похожие материалы</h2>
      <div class="related-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(160px,1fr)); gap:12px;">
        @foreach($relatedStones as $it)
          @php
            $photoUrl = null;
            if ($it->photo_path) {
                $exists = \Illuminate\Support\Facades\Storage::disk('public')->exists($it->photo_path);
                if ($exists) { $photoUrl = \Illuminate\Support\Facades\Storage::url($it->photo_path); }
            }
          @endphp
          <a href="{{ route('catalog.stones.show', $it) }}" class="catalog-tile" style="display:block; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:12px; overflow:hidden; text-decoration:none; color:inherit; min-height:unset !important; height:auto !important;">
            <img class="thumb" src="{{ $photoUrl ?: 'https://via.placeholder.com/600x400?text=Stone' }}" alt="{{ $it->name }}" loading="lazy" width="600" height="300" style="height:120px; object-fit:cover;">
            <div class="meta" style="padding:8px;">
              <h3 style="margin:0 0 4px 0; font-size:0.9rem;">{{ $it->name }}</h3>
              <div class="tags" style="display:flex; gap:4px; flex-wrap:wrap;">
                @if(optional($it->material)->name)
                  <span class="tag" style="padding:2px 6px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); border-radius:8px; font-size:.7rem;">{{ optional($it->material)->name }}</span>
                @endif
                @if($it->color)
                  <span class="tag" style="padding:2px 6px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); border-radius:8px; font-size:.7rem;">{{ $it->color }}</span>
                @endif
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <div id="lightboxOverlay" class="lightbox-overlay" role="dialog" aria-modal="true" aria-label="Просмотр изображения" style="display:none;">
    <img id="lightboxImage" src="" alt="Просмотр">
    <div class="lightbox-close-hint">Нажмите в любое место или Esc, чтобы закрыть</div>
  </div>

  @php
    // флаги уже рассчитаны выше перед блоком тэгов; дублируем для читаемости секций ниже
    $materialName = optional($stone->material)->name;
    $materialNameLc = $materialName ? mb_strtolower($materialName) : null;
    $isQuartz = $materialNameLc && (str_contains($materialNameLc, 'кварц') || str_contains($materialNameLc, 'quartz'));
    $isAcrylic = $materialNameLc && (str_contains($materialNameLc, 'акрил') || str_contains($materialNameLc, 'acrylic'));
  @endphp

  @if($isQuartz)
  <section class="material-gallery" style="padding: 40px 0; background: rgba(255,255,255,0.02); border-radius: 20px; margin: 40px 0;">
    <div class="container">
      <h2 style="margin: 0 0 30px 0; text-align: center; font-size: 2rem; font-weight: 700; color: #fff;">Кварцевый камень - параметры обработки камня</h2>
      
      <div class="gallery-grid" style="display: grid; grid-template-columns: 1fr; gap: 20px;">

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Кромки изделий из кварца</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 10px;">
            @php
              $quartzEdges = ['k1_.jpg', 'k2_.jpg', 'k3_.jpg', 'k4_.jpg', 'k5_.jpg', 'k6_.jpg', 'k7_.jpg', 'k8_.jpg', 'k9_.jpg', 'k10_.jpg', 'k11_.jpg', 'k12_.jpg', 'k13_.jpg', 'k14_.jpg', 'k15_.jpg', 'k16_.jpg'];
              usort($quartzEdges, function ($a, $b) {
                preg_match('/(\d+)/', $a, $ma); $na = isset($ma[1]) ? (int)$ma[1] : PHP_INT_MAX;
                preg_match('/(\d+)/', $b, $mb); $nb = isset($mb[1]) ? (int)$mb[1] : PHP_INT_MAX;
                return $na <=> $nb;
              });
            @endphp
            @foreach($quartzEdges as $i => $edge)
              @php
                $edgeNum = null;
                if (preg_match('/(\d+)/', $edge, $m)) { $edgeNum = $m[1]; }
                if (!$edgeNum) { $edgeNum = $i + 1; }
              @endphp
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/quartz-stone/edges/' . $edge) }}" 
                     alt="Кромка {{ $edgeNum }}" 
                     style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">Кромка {{ $edgeNum }}</div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Бортики изделий из кварца</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 10px;">
            @php
              $quartzBumpers = ['B1-1_.jpg', 'B2-1_.jpg', 'B3-2-1_.jpg'];
            @endphp
            @foreach($quartzBumpers as $i => $bumper)
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/quartz-stone/bumpers/' . $bumper) }}" 
                     alt="Борт {{ $i+1 }}" 
                     style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">Бортик {{ $i+1 }}</div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Встраиваемые мойки</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 10px;">
            @php
              $quartzSinks = ['mo-1_.jpg', 'mo-2_.jpg', 'mo-3_.jpg'];
            @endphp
            @foreach($quartzSinks as $sink)
              @php
                $num = null;
                if (stripos($sink, 'model-k') !== false) {
                  $num = 'K';
                } elseif (preg_match('/(\d+)/', $sink, $m)) {
                  $num = $m[1];
                }
              @endphp
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/quartz-stone/sinks/' . $sink) }}" 
                     alt="Мойка {{ $sink }}" 
                     style="width: 100%; height: 560px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">Мойка: {{ $num ?? '' }}</div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  @if($isAcrylic)
  <section class="material-gallery" style="padding: 40px 0; background: rgba(255,255,255,0.02); border-radius: 20px; margin: 40px 0;">
    <div class="container">
      <h2 style="margin: 0 0 30px 0; text-align: center; font-size: 2rem; font-weight: 700; color: #fff;">Акриловый камень - параметры обработки камня</h2>
      
      <div class="gallery-grid" style="display: grid; grid-template-columns: 1fr; gap: 20px;">

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Кромки изделий из акрила</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px;">
            @php
              $acrylicEdges = [
                'big-tt-kromka-i-mg12_.jpg', 'big-tt-kromka-i-mg13_.jpg', 'big-tt-kromka-i-mg14.jpg',
                'big-tt-kromka-img1.jpg', 'big-tt-kromka-img2.jpg', 'big-tt-kromka-img3.jpg',
                'big-tt-kromka-img4.jpg', 'big-tt-kromka-img5.jpg', 'big-tt-kromka-img6.jpg',
                'big-tt-kromka-img7.jpg', 'big-tt-kromka-img8.jpg', 'big-tt-kromka-img9.jpg',
                'big-tt-kromka-img10.jpg', 'big-tt-kromka-img11.jpg'
              ];
              usort($acrylicEdges, function ($a, $b) {
                preg_match('/(\d+)/', $a, $ma); $na = isset($ma[1]) ? (int)$ma[1] : PHP_INT_MAX;
                preg_match('/(\d+)/', $b, $mb); $nb = isset($mb[1]) ? (int)$mb[1] : PHP_INT_MAX;
                return $na <=> $nb;
              });
            @endphp
            @foreach($acrylicEdges as $i => $edge)
              @php
                $edgeNum = null;
                if (preg_match('/(\d+)/', $edge, $m)) { $edgeNum = $m[1]; }
                if (!$edgeNum) { $edgeNum = $i + 1; }
              @endphp
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/acrylic-stone/edges/' . $edge) }}" 
                     alt="Кромка {{ $edgeNum }}" 
                     style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">Кромка {{ $edgeNum }}</div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Бортики изделий из акрила</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px;">
            @for($i = 1; $i <= 4; $i++)
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/acrylic-stone/bumpers/big-tt-bortik-img' . $i . '.jpg') }}" 
                     alt="Борт {{ $i }}" 
                     style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">
                  @if($i <= 2)
                    Бортик, до 50 мм
                  @else
                    Бортик 51-100 мм
                  @endif
                </div>
              </div>
            @endfor
          </div>
        </div>

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Встраиваемые мойки</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 10px;">
            @php
              $sinkImages = ['201.jpg', '202.jpg', '203.jpg', '204.jpg', '205.jpg', '205r.jpg', '304.jpg', '362.jpg', '388.jpg', '390.jpg', '413.jpg', '422.jpg', '500.jpg', 'k.jpg'];
            @endphp
            @foreach($sinkImages as $sinkImage)
              @php
                $num = null;
                if (stripos($sinkImage, 'k') !== false) {
                  $num = 'K';
                } elseif (preg_match('/(\d+)/', $sinkImage, $m)) {
                  $num = $m[1];
                  // Добавляем R для файлов с суффиксом r
                  if (stripos($sinkImage, 'r') !== false) {
                    $num .= 'R';
                  }
                }
              @endphp
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/acrylic-stone/sinks-and-sinks-made/' . $sinkImage) }}" 
                     alt="Мойка {{ $sinkImage }}" 
                     style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">Модель №{{ $num ?? '' }}</div>
              </div>
            @endforeach
          </div>
          
          <div class="acrylic-sink-info">
            <p>
              Следует учитывать, что из акрилового камня некоторых коллекций с крупными включениями и 3D эффектом раковины делать не рекомендуется, поскольку этот камень не всегда хорошо поддается термоформингу. Подберите цвет камня в нашем Каталоге камня. Наши менеджеры просчитают ориентировочную стоимость изделия.
            </p>
            <p>
              *В готовых изделиях моделей 201, 202, 203 и 204 возможно незначительное изменение оттенка камня. У камня темных насыщенных цветов вероятность изменения оттенка выше.
            </p>
            <p>
              *Мойки производителя Neomarm - возможно сделать только квадратные, также на торце возможны незначительные полосы.
            </p>
          </div>
        </div>

      </div>

      <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 30px;">

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Дополнительные услуги</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px;">
            <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
              <img class="lightboxable" src="{{ asset('images/acrylic-stone/additional-services/big-tt-img-kapelnik.jpg') }}" 
                   alt="Капельник" 
                   style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                   loading="lazy">
              <div style="text-align:center; font-size: .8rem; color:#bbb;">Капельник</div>
            </div>
            <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
              <img class="lightboxable" src="{{ asset('images/acrylic-stone/additional-services/big-tt-img-prutki.jpg') }}" 
                   alt="Прутки под горячее" 
                   style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                   loading="lazy">
              <div style="text-align:center; font-size: .8rem; color:#bbb;">Прутки под горячее</div>
            </div>
            <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
              <img class="lightboxable" src="{{ asset('images/acrylic-stone/additional-services/big-tt-kromka-img-inkrustaciya.jpg') }}" 
                   alt="Инструкция камня" 
                   style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                   loading="lazy">
              <div style="text-align:center; font-size: .8rem; color:#bbb;">Инструкция камня</div>
            </div>
            <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
              <img class="lightboxable" src="{{ asset('images/acrylic-stone/additional-services/big-tt-kromka-img-podvorot1.jpg') }}" 
                   alt="Подклейка камня снизу" 
                   style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                   loading="lazy">
              <div style="text-align:center; font-size: .8rem; color:#bbb;">Подклейка камня снизу</div>
            </div>
          </div>
        </div>

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Направляющие для слива</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px;">
            @for($i = 1; $i <= 4; $i++)
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/acrylic-stone/guides-for-draining-water-in-countertops/' . $i . '_-1.jpg') }}" 
                     alt="Направляющая {{ $i }}" 
                     style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">Вариант №{{ $i }}</div>
              </div>
            @endfor
          </div>
        </div>

        <div class="gallery-section">
          <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; color: #fff; text-align: center;">Типы горячих вставок</h3>
          <div class="gallery-images" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px;">
            @for($i = 1; $i <= 4; $i++)
              <div style="display:flex; flex-direction:column; gap:6px; align-items:stretch;">
                <img class="lightboxable" src="{{ asset('images/acrylic-stone/types-of-hot-inserts/' . $i . '_.jpg') }}" 
                     alt="Горячая вставка {{ $i }}" 
                     style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);"
                     loading="lazy">
                <div style="text-align:center; font-size: .8rem; color:#bbb;">Вариант №{{ $i }}</div>
              </div>
            @endfor
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  <div id="pricingModal" class="pricing-modal">
    <div class="pricing-modal-content">
      <button class="pricing-modal-close" onclick="closePricingModal()">&times;</button>
      <h2 id="pricingModalTitle">Стоимость услуг</h2>
      <ul class="pricing-list" id="pricingList">

      </ul>
      <div class="pricing-disclaimer">
        <p><strong>Для расчета точной стоимости</strong> необходимо связаться через форму заявки или позвонив напрямую</p>
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  (function() {
    const overlay = document.getElementById('lightboxOverlay');
    const overlayImg = document.getElementById('lightboxImage');
    if (!overlay || !overlayImg) return;

    function openLightbox(src, alt) {
      overlayImg.src = src;
      overlayImg.alt = alt || 'Просмотр';
      overlay.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      overlay.style.display = 'none';
      overlayImg.src = '';
      document.body.style.overflow = '';
    }

    document.addEventListener('click', function(e) {
      const img = e.target.closest('img.lightboxable');
      if (img) {
        e.preventDefault();
        openLightbox(img.src, img.alt);
        return;
      }
    });

    overlay.addEventListener('click', function() { closeLightbox(); });
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeLightbox();
    });
  })();

  // Прайс-листы для разных типов камня с группировкой
  const pricingData = {
    acrylic: {
      title: 'Стоимость услуг для акрилового камня',
      groups: [
        {
          title: 'Бесплатные услуги',
          items: [
            { name: 'Стыковка стеновой панели с горизонтальной плоскостью', price: 'Бесплатно' },
            { name: 'Изготовление радиусного элемента', price: 'Бесплатно' },
            { name: 'Вырез по месту под розетки, трубы, смеситель', price: 'Бесплатно' },
            { name: 'Склейка (стыковка) двух поверхностей', price: 'Бесплатно' }
          ]
        },
        {
          title: 'Обработка и монтаж',
          items: [
            { name: 'Увеличение толщины столешницы (от 50мм. до 70мм.)', price: '1680 РУБ / МП' },
            { name: 'Стыковка стеновой панели с плавным переходом', price: '3840 РУБ / МП' },
            { name: 'Вырез по месту для варочной панели, мойки', price: '1560 РУБ / ШТ' },
            { name: 'Вырез варочной панели, мойки в уровень', price: '5760 РУБ / ШТ' },
            { name: 'Установка мойки под столешницу', price: '2760 РУБ / ШТ' },
            { name: 'Проточки сквозные для батарей', price: '4080 РУБ / 10ШТ' },
            { name: 'Изделье S до 1м2 = 1м2 и меньше 2м2', price: '5000 РУБ + Покраска основания' },
            { name: 'Монтаж изделия', price: '2760 РУБ / М2' }
          ]
        },
        {
          title: 'Доставка и логистика',
          items: [
            { name: 'Выезд замерщика без заключения договора', price: '2400 РУБ' },
            { name: 'Доставка в пределах МКАД и менее 20км. от МКАД', price: 'от 2400 РУБ' },
            { name: 'Выезд за МКАД более 20 км.', price: '70 РУБ / 1КМ' },
            { name: 'Ручной подъём', price: '200 РУБ / 1ЭТ' },
            { name: 'Дополнительный выезд', price: '3600 РУБ' }
          ]
        }
      ]
    },
    quartz: {
      title: 'Стоимость услуг для кварцевого камня',
      groups: [
        {
          title: 'Обработка отверстий',
          items: [
            { name: 'Отверстие под варочную панель, мойку', price: '1800 РУБ / ШТ' },
            { name: 'Отверстие под смеситель, дозатор, розетку', price: '1320 РУБ / ШТ' },
            { name: 'Вырез и установка мойки под столешницу', price: '4800 РУБ / ШТ' },
            { name: 'Установка мойки, варочной панели в уровень столешницы', price: '8400 РУБ / ШТ' }
          ]
        },
        {
          title: 'Монтаж и стыковка',
          items: [
            { name: 'Стеновая панель', price: '1800 РУБ / МП' },
            { name: 'Стык', price: '1800 РУБ / ШТ' },
            { name: 'Стыковка ноги с фаской', price: '3600 РУБ / ШТ' },
            { name: 'Стыковка ноги под 45 градусов', price: '7200 РУБ / ШТ' },
            { name: 'Обработка тыльной стороны (полировка)', price: '2400 РУБ / М2' },
            { name: 'Тара', price: '7200 РУБ / М2' }
          ]
        },
        {
          title: 'Дополнительные работы',
          items: [
            { name: 'Проточки для стока воды к мойке', price: '4800 РУБ / 5ШТ' },
            { name: 'Проточки сквозные под батареи', price: '7200 РУБ / 10ШТ' },
            { name: 'Хромированные стержни под горячее', price: '8400 РУБ / ШТ' }
          ]
        },
        {
          title: 'Специальные услуги',
          items: [
            { name: 'Столешница, подоконник, стеновая', price: '1800 РУБ / МП' },
            { name: 'Столешница переходящая в подоконник (H-20/H-30)', price: '6000 РУБ / ШТ' },
            { name: 'Калибровка', price: '4800 РУБ / М2' },
            { name: 'Подбор рисунка', price: '4800 РУБ / 1ЛИСТ' },
            { name: 'Минимальная стоимость работ', price: '20000 РУБ' }
          ]
        },
        {
          title: 'Доставка и логистика',
          items: [
            { name: 'Выезд замерщика без заключения договора', price: '2400 РУБ' },
            { name: 'Доставка в пределах МКАД и менее 20км. от МКАД', price: 'от 2400 РУБ' },
            { name: 'Выезд за МКАД более 20 км.', price: '70 РУБ / 1КМ' },
            { name: 'Ручной подъём', price: '1200 РУБ / 1ЭТ' },
            { name: 'Дополнительный выезд', price: '6000 РУБ' }
          ]
        }
      ]
    }
  };

  // Функции для работы с модальным окном
  function openPricingModal() {
    const modal = document.getElementById('pricingModal');
    const title = document.getElementById('pricingModalTitle');
    const list = document.getElementById('pricingList');
    
    // Определяем тип камня
    const materialName = '{{ optional($stone->material)->name }}'.toLowerCase();
    const isQuartz = materialName.includes('кварц') || materialName.includes('quartz');
    const isAcrylic = materialName.includes('акрил') || materialName.includes('acrylic');
    
    let pricingType = 'acrylic'; // по умолчанию
    if (isQuartz) {
      pricingType = 'quartz';
    } else if (isAcrylic) {
      pricingType = 'acrylic';
    }
    
    const data = pricingData[pricingType];
    
    // Заполняем модальное окно
    title.textContent = data.title;
    list.innerHTML = '';
    
    // Создаем группы
    data.groups.forEach(group => {
      const groupDiv = document.createElement('div');
      groupDiv.className = 'pricing-group';
      
      const groupTitle = document.createElement('h3');
      groupTitle.className = 'pricing-group-title';
      groupTitle.textContent = group.title;
      groupDiv.appendChild(groupTitle);
      
      const groupList = document.createElement('ul');
      groupList.className = 'pricing-list';
      
      group.items.forEach(item => {
        const li = document.createElement('li');
        li.className = 'pricing-item';
        li.innerHTML = `
          <span class="pricing-item-name">${item.name}</span>
          <span class="pricing-item-price">${item.price}</span>
        `;
        groupList.appendChild(li);
      });
      
      groupDiv.appendChild(groupList);
      list.appendChild(groupDiv);
    });
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closePricingModal() {
    const modal = document.getElementById('pricingModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }

  // Закрытие модального окна по клику вне его
  document.getElementById('pricingModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closePricingModal();
    }
  });

  // Закрытие по Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closePricingModal();
    }
  });
</script>
@endpush


