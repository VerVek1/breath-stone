<header>
    <div class="container header-content">
        <a href="/" class="logo" aria-label="BreathStone">
            <span class="logo-icon" aria-hidden="true">
                <svg width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" role="img">
                    <title>BreathStone</title>
                    <desc>Simple faceted stone icon</desc>
                    
                    <path d="M18 3 L30 11 L30 25 L18 33 L6 25 L6 11 Z" fill="none" stroke="currentColor" stroke-width="2"/>
                    <path d="M18 7.8 L26 13 L26 23 L18 28.2 L10 23 L10 13 Z" fill="currentColor" opacity="0.12"/>
                    
                    <path d="M8.8 12.5 L18 18 L27.2 12.5" stroke="currentColor" stroke-width="1.4" opacity="0.4"/>
                </svg>
            </span>
            <strong>Breath</strong><span>Stone</span>
        </a>
        <nav class="main-nav">
            <ul class="nav-list" id="main-menu" role="menu">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">О нас</a></li>
                <li><a href="{{ route('catalog.stones') }}" class="{{ request()->is('catalog') ? 'active' : '' }}">Каталог камня</a></li>
                <li><a href="/contacts" class="{{ request()->is('contacts') ? 'active' : '' }}">Контакты</a></li>
            </ul>
            <button class="header-btn" data-modal-open>Заказать звонок</button>
            <button class="theme-toggle switch" id="themeToggle" aria-label="Переключить тему" aria-pressed="false">
                <span class="track" aria-hidden="true"></span>
                <span class="knob" aria-hidden="true"></span>
            </button>
            <button class="burger" aria-label="Открыть меню" aria-controls="main-menu" aria-expanded="false"><span></span><span></span><span></span></button>
        </nav>
    </div>
    <div class='menu-overlay'></div>
</header>



