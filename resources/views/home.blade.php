@extends('layouts.app')

@section('title', 'Столешницы из искусственного камня | Breath Stone')
@section('meta')
<meta name="description" content="Изготовление изделий из искусственного камня в Москве и Московской области: столешницы, подоконники, ступени, камины. Производство в Мытищах, замер, доставка и монтаж, гарантия 10 лет.">
<meta name="yandex-verification" content="8fe0c38078b904ef" />
<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
@include('partials.header')

<section class="hero">
    <div class="hero-slider">
        <div class="slider-track">
            <div class="slider-item active">
                <img src="{{ url('/images/products/main-slider-slide-1.jpg') }}" alt="Камин из искусственного камня">
            </div>
            <div class="slider-item">
                <img src="{{ url('/images/products/main-slider-slide-2.jpg') }}" alt="Ступени из искусственного камня">
            </div>
            <div class="slider-item">
                <img src="{{ url('/images/products/main-slider-slide-3.jpg') }}" alt="Столешница из искусственного камня">
            </div>
        </div>
    </div>
    <div class="container hero-content">
        <h1>Столешницы из искусственного камня на заказ</h1>
        <p>Собственное производство в Мытищах. Изготовление, доставка и монтаж. Бесплатный выезд замерщика,</br> гарантия 10 лет по договору, более 200 цветов и фактур.</p>
    </div>
</section>

@include('partials.advantages')
<section class="catalog-home">
    <div class="container" style="padding: 80px 24px;">
        <div class="catalog-header">
            <h2>Примеры нашей продукции</h2>
            <p>Изделия из искусственного камня: столешницы, подоконники, ступени, камины и панели</p>
        </div>

        <section class="catalog-section">
            @php 
                $img = '/images/catalog'; 
                $items = [
                    // Столешницы
                    ['stoleshnitsy','slide1.jpg','Столешница бежевая под мрамор','СП1'],
                    
                    // Камины
                    ['kaminy', 'slide2.jpg','Камин бежевый под мрамор','К1'],
                    
                    // Панели
                    ['paneli','slide3.jpg','Панель серая с вкраплениями','П1'],
                    
                    // Подоконники
                    ['podokonniki', 'slide4.jpg','Подоконники бежевые под мрамор','ПОД1'],
                    
                    // Ресепшн
                    ['resepshn', 'slide5.jpg','Ресепшн белый однотонный','Р1'],
                    
                    // Столешницы в ванную
                    ['stoleshnitsy-v-vannuyu','slide6.jpg','Столешница в ванную белая','СВ1'],
                    
                    // Столы
                    ['stoly','slide7.jpg','Стол коричневый с вкраплениями','СТОЛ1'],
                    
                    // Ступени
                    ['stupeni', 'slide8.jpg','Ступени белые с вкраплениями','СТ1'],
                ];
                $groups = [
                    'stoleshnitsy' => [],
                    'stupeni' => [],
                    'kaminy' => [],
                    'paneli' => [],
                    'podokonniki' => [],
                    'resepshn' => [],
                    'stoly' => [],
                    'stoleshnitsy-v-vannuyu' => [],
                ];
                foreach ($items as [$cat, $file, $title, $art]) { $groups[$cat][] = [$file,$title,$art]; }
                $titles = [
                    'stoleshnitsy' => 'Столешницы',
                    'stupeni' => 'Ступени',
                    'kaminy' => 'Камины',
                    'paneli' => 'Панели',
                    'podokonniki' => 'Подоконники',
                    'resepshn' => 'Ресепшн',
                    'stoly' => 'Столы',
                    'stoleshnitsy-v-vannuyu' => 'Столешницы в ванную',
                ];
                // SEO-описания для новых слайдов
                $descriptions = [
                    // Столешницы
                    'slide1.jpg' => 'Столешница из искусственного камня бежевого цвета с текстурой под мрамор. Элегантный дизайн, влагостойкая поверхность, легко моется и ухаживается.',
                    'slide6.jpg' => 'Столешница для ванной комнаты из белого искусственного камня однотонной текстуры. Влагостойкая, гигиеничная поверхность, идеально подходит для ванных комнат.',
                    
                    // Ступени и подоконники
                    'slide8.jpg' => 'Ступени из белого искусственного камня с мелкими вкраплениями. Противоскользящая поверхность, износостойкость, подходят для внутренних лестниц.',
                    'slide4.jpg' => 'Подоконники из бежевого искусственного камня с текстурой под мрамор. Теплоизоляция, влагостойкость, элегантный внешний вид.',
                    
                    // Камины и ресепшн
                    'slide2.jpg' => 'Камин из бежевого искусственного камня с текстурой под мрамор. Устойчив к высоким температурам, легко моется, создает уютную атмосферу.',
                    'slide5.jpg' => 'Ресепшн из белого однотонного искусственного камня. Профессиональный вид, износостойкая поверхность, идеально для офисов и общественных помещений.',
                    
                    // Панели и столы
                    'slide3.jpg' => 'Панель из серого искусственного камня с мелкими вкраплениями. Декоративная стеновая панель, влагостойкая поверхность, современный дизайн.',
                    'slide7.jpg' => 'Стол из коричневого искусственного камня с мелкими вкраплениями. Прочная поверхность, устойчивость к царапинам, элегантный внешний вид.',
                ];
                // Showcase: take one item per category in a fixed order (8 slides total)
                $order = ['stoleshnitsy','kaminy','paneli','podokonniki','resepshn','stoleshnitsy-v-vannuyu','stoly','stupeni'];
                $showcase = [];
                foreach ($order as $c) {
                    if (!empty($groups[$c][0])) {
                        $showcase[] = [$c, $groups[$c][0][0], $groups[$c][0][1], $groups[$c][0][2]];
                    }
                }
            @endphp

            @if (count($showcase))
            <div class="product-carousel" data-carousel="showcase" aria-roledescription="carousel" aria-label="Витрина – карусель товаров">
                <div class="pc-slides" role="group" tabindex="0" aria-live="polite">
                    @foreach ($showcase as [$cat,$file,$title,$art])
                    <article class="pc-slide" aria-hidden="true">
                        <div class="catalog-card" data-category="{{$cat}}">
                            <div class="thumb">
                                <img src="{{$img}}/{{$file}}" alt="{{$title}}">
                                <span class="card-chip" aria-hidden="true">{{ $titles[$cat] }}</span>
                            </div>
                            <div class="meta">
                                @php $desc = $descriptions[$file] ?? ( $titles[$cat].' «'.$title.'» из искусственного камня. Изготовление под заказ, замер, доставка и монтаж.' ); @endphp
                                <p class="desc" style="margin:8px 0 0 0; color:#a9a9a9; line-height:1.45;">{{$desc}}</p>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="pc-indicators" role="tablist" aria-label="Индикатор слайдов">
                    @foreach ($showcase as $_i => $_)
                    <button type="button" class="pc-dot" role="tab" aria-selected="false" aria-label="Слайд {{ $_i + 1 }}" data-pc-dot data-index="{{ $_i }}"></button>
                    @endforeach
                </div>
            </div>
            @endif
        </section>
    </div>
</section>
<div class="container" style="text-align:center;margin:-64px auto 64px auto;">
    <button type="button" class="btn" style="display:inline-block;" data-modal-open>Оставить заявку</button>
</div>
@include('partials.materials')

<section class="seo-text">
    <div class="container">
        <div class="seo-content">
            <h2>Изготовление столешниц из искусственного камня в Мытищах</h2>
            
            <p>Компания Breath Stone специализируется на производстве и установке столешниц из искусственного камня в Московской области. Наше собственное производство в Мытищах позволяет изготавливать качественные изделия по доступным ценам с гарантией 10 лет.</p>
            
            <h3>Виды искусственного камня</h3>
            <p>Мы работаем с различными видами искусственного камня: акриловый камень и кварцевый агломерат. Каждый материал имеет свои преимущества:</p>
            <ul>
                <li><strong>Акриловый камень</strong> - теплый на ощупь, легко реставрируется, бесшовные соединения</li>
                <li><strong>Кварцевый агломерат</strong> - высокая прочность, устойчивость к царапинам и пятнам</li>
            </ul>
            
            <h3>Наша продукция</h3>
            <p>Изготавливаем широкий ассортимент изделий из искусственного камня:</p>
            <ul>
                <li><strong>Столешницы для кухни</strong> - с интегрированными мойками, варочными панелями, точной подгонкой по месту</li>
                <li><strong>Подоконники</strong> - влагостойкие, с утеплением, подоконные доски любой длины</li>
                <li><strong>Ступени</strong> - с противоскользящей кромкой, фаской, для внутренних и наружных лестниц</li>
                <li><strong>Камины</strong> - устойчивые к высоким температурам, с точной подгонкой элементов</li>
                <li><strong>Панели</strong> - декоративные стеновые панели для ванных комнат и кухонь</li>
                <li><strong>Столы</strong> - обеденные и журнальные столы из искусственного камня</li>
            </ul>
            
            <h3>Преимущества работы с нами</h3>
            <p>Выбирая Breath Stone, вы получаете:</p>
            <ul>
                <li>Собственное производство в Мытищах - контроль качества на всех этапах</li>
                <li>Более 200 цветов и фактур искусственного камня</li>
                <li>Бесплатный выезд замерщика по Москве и области</li>
                <li>Профессиональный монтаж с гарантией качества</li>
                <li>Доставка готовых изделий в срок</li>
                <li>Гарантия 10 лет по договору</li>
                <li>Конкурентные цены без посредников</li>
            </ul>
            
            <h3>Процесс изготовления</h3>
            <p>Изготовление столешниц из искусственного камня включает несколько этапов:</p>
            <ol>
                <li>Выезд замерщика для точных замеров</li>
                <li>Разработка 3D-проекта изделия</li>
                <li>Раскрой материала на высокоточном оборудовании</li>
                <li>Обработка кромок и полировка поверхности</li>
                <li>Фрезеровка под мойку и варочную панель</li>
                <li>Доставка и профессиональный монтаж</li>
            </ol>
            
            <p>Наши мастера имеют многолетний опыт работы с искусственным камнем и используют современное оборудование для достижения идеального результата. Каждое изделие проходит контроль качества перед отправкой заказчику.</p>
            
            <p>Обращайтесь в Breath Stone для изготовления столешниц, подоконников, ступеней и других изделий из искусственного камня. Мы гарантируем высокое качество, соблюдение сроков и доступные цены.</p>
        </div>
    </div>
</section>


<script>
// hero slider (guards when no slides present)
const heroSliderItems = document.querySelectorAll('.hero-slider .slider-item');
let heroCurrent = 0;
function showHeroSlide(idx) { heroSliderItems.forEach((item, i) => item.classList.toggle('active', i === idx)); }
if (heroSliderItems.length > 0) {
  showHeroSlide(heroCurrent);
  if (heroSliderItems.length > 1) {
    setInterval(() => { heroCurrent = (heroCurrent + 1) % heroSliderItems.length; showHeroSlide(heroCurrent); }, 5000);
  }
}

// burger + overlay
const burger = document.querySelector('.burger');
const navList = document.querySelector('.nav-list');
const overlay = document.querySelector('.menu-overlay');
function closeMenu(){ navList.classList.remove('open'); burger.classList.remove('open'); overlay.classList.remove('active'); }
if (burger && navList && overlay) {
  burger.addEventListener('click', () => { navList.classList.toggle('open'); burger.classList.toggle('open'); overlay.classList.toggle('active'); });
  overlay.addEventListener('click', closeMenu);
}

// theme handled globally in layout

// modal
const modal = document.querySelector('[data-modal]');
const modalOverlay = document.querySelector('[data-modal-overlay]');
const modalOpenButtons = document.querySelectorAll('[data-modal-open], .header-btn');
const modalCloseButtons = document.querySelectorAll('[data-modal-close]');
function openModal(){ if(!modal||!modalOverlay) return; modal.classList.add('open'); modalOverlay.classList.add('active'); document.body.style.overflow='hidden'; }
function closeModal(){ if(!modal||!modalOverlay) return; modal.classList.remove('open'); modalOverlay.classList.remove('active'); document.body.style.overflow=''; }
modalOpenButtons.forEach(btn=>btn.addEventListener('click', (e)=>{ e.preventDefault(); openModal(); }));
modalCloseButtons.forEach(btn=>btn.addEventListener('click', (e)=>{ e.preventDefault(); closeModal(); }));
if (modalOverlay) modalOverlay.addEventListener('click', closeModal);
document.addEventListener('keydown', (e)=>{ if(e.key==='Escape') closeModal(); });
// Product carousel: 3-up, smooth, auto 4s, instant wrap via arrows
document.querySelectorAll('.product-carousel').forEach((carousel)=>{
  const track = carousel.querySelector('.pc-slides');
  const prevBtn = carousel.querySelector('[data-pc-prev]');
  const nextBtn = carousel.querySelector('[data-pc-next]');
  if (!track) return;
  const slides = [...track.querySelectorAll('.pc-slide')];
  const dotsAll = [...carousel.querySelectorAll('[data-pc-dot]')];
  function getItemsPerView(){
    const w = window.innerWidth || document.documentElement.clientWidth;
    if (w <= 640) return 1;
    if (w <= 1318) return 2;
    return 3;
  }
  let itemsPerView = getItemsPerView();
  // Enforce exactly 3 visible cards
  track.style.gap = track.style.gap || '16px';
  track.style.columnGap = track.style.columnGap || '16px';
  function applyGridColumns(){
    const gapPx = 16;
    const denom = itemsPerView === 1 ? 1 : itemsPerView;
    const gapTotal = itemsPerView > 1 ? gapPx * (itemsPerView - 1) : 0;
    const col = `calc((100% - ${gapTotal}px) / ${denom})`;
    track.style.gridAutoColumns = col;
  }
  applyGridColumns();

  function getStep(){
    const style = getComputedStyle(track);
    const gap = parseFloat(style.columnGap || style.gap || '16');
    const slideEl = track.querySelector('.pc-slide');
    const slideWidth = slideEl ? slideEl.clientWidth : track.clientWidth / itemsPerView;
    return slideWidth + gap;
  }

  const total = slides.length;
  let lastStart = Math.max(0, total - itemsPerView);
  let currentStart = 0; // index of the first visible card
  let suppressSync = false; // suppress scroll sync during programmatic jumps

  function syncDots(){
    if (!dotsAll.length) return;
    const pageCount = lastStart + 1; // number of valid start positions
    dotsAll.forEach((d, i)=>{
      const isValid = i < pageCount;
      d.setAttribute('aria-selected', isValid && i === currentStart ? 'true' : 'false');
      d.setAttribute('aria-disabled', isValid ? 'false' : 'true');
      if (!isValid) d.style.display = 'none'; else d.style.display = '';
    });
  }

  function goTo(index, behavior = 'smooth'){
    currentStart = Math.max(0, Math.min(lastStart, index));
    const left = currentStart * getStep();
    track.scrollTo({ left, behavior });
    syncDots();
  }

  function next(){
    if (currentStart >= lastStart) {
      // stop at the last page (no wrap to first)
      if (typeof pause === 'function') pause();
      return;
    } else {
      goTo(currentStart + 1, 'smooth');
    }
  }

  function prev(){
    if (currentStart <= 0) {
      // stop at the first page (no wrap to last)
      if (typeof pause === 'function') pause();
      return;
    } else {
      goTo(currentStart - 1, 'smooth');
    }
  }

  if (nextBtn) nextBtn.addEventListener('click', next);
  if (prevBtn) prevBtn.addEventListener('click', prev);

  // Dot click navigation (page-based): each dot represents a page (start index)
  if (dotsAll.length) {
    dotsAll.forEach((dot)=>{
      dot.addEventListener('click', ()=>{
        if (dot.getAttribute('aria-disabled') === 'true') return;
        let idx = parseInt(dot.getAttribute('data-index')||'0', 10);
        idx = Math.max(0, Math.min(lastStart, idx));
        goTo(idx, 'smooth');
      });
    });
    // initialize selected
    syncDots();
  }

  // Keyboard
  track.addEventListener('keydown', (e)=>{
    if (e.key === 'ArrowRight') { e.preventDefault(); next(); }
    if (e.key === 'ArrowLeft')  { e.preventDefault(); prev(); }
  });

  // Keep currentStart in sync with manual scrolls
  let raf = null;
  track.addEventListener('scroll', ()=>{
    if (suppressSync) return;
    if (raf) return;
    raf = requestAnimationFrame(()=>{
      const step = getStep();
      const approx = Math.round(track.scrollLeft / step);
      currentStart = Math.max(0, Math.min(lastStart, approx));
      raf = null;
      syncDots();
    });
  });

  // Auto-advance every 4s
  let autoTimer = setInterval(next, 4000);
  function pause(){ if (autoTimer) { clearInterval(autoTimer); autoTimer = null; } }
  function resume(){ if (!autoTimer) autoTimer = setInterval(next, 4000); }
  carousel.addEventListener('mouseenter', pause);
  carousel.addEventListener('mouseleave', resume);
  track.addEventListener('focusin', pause);
  track.addEventListener('focusout', resume);

  // Recompute on resize and keep logical position
  let resizeTimer = null;
  window.addEventListener('resize', ()=>{
    if (resizeTimer) clearTimeout(resizeTimer);
    resizeTimer = setTimeout(()=>{
      const prevItems = itemsPerView;
      itemsPerView = getItemsPerView();
      applyGridColumns();
      lastStart = Math.max(0, total - itemsPerView);
      currentStart = Math.max(0, Math.min(lastStart, currentStart));
      goTo(currentStart, 'auto');
      syncDots();
    }, 150);
  });

  // Init
  goTo(0, 'auto');
  syncDots();
});
</script>
@endsection



