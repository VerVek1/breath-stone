<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <meta name="theme-color" content="#111111">
    <meta name="msapplication-TileColor" content="#111111">
    <meta name="msapplication-TileImage" content="{{ asset('mstile-144x144.png') }}">
    <title>@yield('title', 'Breath Stone')</title>
    @yield('meta')
    <style>html.theme-init{visibility:hidden}.no-anim *{transition:none!important}
      .page-wrap{min-height:100vh;display:flex;flex-direction:column}
      .page-content{flex:1 0 auto}
      footer{margin-top:auto}
    </style>
    <script src="{{ url('js/theme-init.js') }}" defer></script>
    @php $base = rtrim(request()->getBaseUrl(), '/'); @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/reset.css') }}">
    <link rel="stylesheet" href="{{ url('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .theme-toggle.switch .knob::before { background-image: url("{{ url('images/moon.svg') }}"); }
        body.light .theme-toggle.switch .knob::before { background-image: url("{{ url('images/sun.svg') }}"); }
    </style>
    <script src="{{ url('js/loading.js') }}" defer></script>
    <script src="{{ url('js/burger.js') }}" defer></script>
    <script src="{{ url('js/modal.js') }}" defer></script>
    <script src="{{ url('js/form-handler.js') }}" defer></script>
    <script src="{{ url('js/theme-runtime.js') }}" defer></script>
    <script src="{{ url('js/cookie-notice.js') }}" defer></script>
    <script src="{{ url('js/scroll-to-top.js') }}" defer></script>
@stack('structured_data')
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=104857370', 'ym');

    ym(104857370, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/104857370" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>

<div id="loading-screen" class="loading-screen">
    <div class="loading-content">
        <div class="loading-logo">
            <h1>Breath Stone</h1>
        </div>
        <div class="loading-spinner">
            <div class="spinner"></div>
        </div>
        <div class="loading-text">Загрузка...</div>
    </div>
</div>

<div class="page-wrap">
@if(str_starts_with(request()->path(), 'admin'))
@include('partials.admin-nav')
@endif
<div class="page-content">
@yield('content')
</div>
@include('partials.order-modal')
@include('partials.cookie-notice')
@include('partials.footer')

<button id="scrollToTop" class="scroll-to-top" aria-label="Наверх" title="Наверх">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 19V5M5 12L12 5L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</button>
</div>
@stack('scripts')
</body>
</html>

