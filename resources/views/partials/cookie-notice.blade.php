<div id="cookie-notice" class="cookie-notice" aria-live="polite" role="region" hidden>
    <div class="cookie-notice__inner">
        <div class="cookie-notice__text">
            <p>Сайт использует файлы cookie для улучшения работы и анализа.</p>
            <a class="cookie-notice__link" href="{{ route('cookie.policy') }}">Подробнее</a>
        </div>
        <button type="button" class="cookie-notice__accept" id="cookie-accept" aria-label="Принять использование cookie">
            Хорошо
        </button>
    </div>
</div>

<div id="cookie-notice" class="cookie-notice" style="display: none;">
    <div class="cookie-content">
        <div class="cookie-text">
            <p>Мы используем файлы cookie для улучшения работы сайта и анализа трафика. Продолжая использовать сайт, вы соглашаетесь с нашей <a href="{{ route('privacy.policy') }}" target="_blank">политикой конфиденциальности</a>.</p>
        </div>
        <div class="cookie-actions">
            <button id="cookie-accept" class="cookie-btn cookie-accept">Принять</button>
            <button id="cookie-decline" class="cookie-btn cookie-decline">Отклонить</button>
        </div>
    </div>
</div>

<style>
.cookie-notice {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(17, 24, 39, 0.95);
    backdrop-filter: blur(10px);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding: 16px 20px;
    z-index: 1000;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.cookie-notice.show {
    transform: translateY(0);
}

.cookie-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.cookie-text {
    flex: 1;
    min-width: 300px;
}

.cookie-text p {
    margin: 0;
    color: #e5e7eb;
    font-size: 0.9rem;
    line-height: 1.5;
}

.cookie-text a {
    color: #60a5fa;
    text-decoration: underline;
}

.cookie-text a:hover {
    color: #93c5fd;
}

.cookie-actions {
    display: flex;
    gap: 12px;
    flex-shrink: 0;
}

.cookie-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cookie-accept {
    background: #10b981;
    color: white;
}

.cookie-accept:hover {
    background: #059669;
}

.cookie-decline {
    background: transparent;
    color: #9ca3af;
    border: 1px solid #374151;
}

.cookie-decline:hover {
    background: #374151;
    color: #e5e7eb;
}

/* Light theme */
body.light .cookie-notice {
    background: rgba(255, 255, 255, 0.95);
    border-top-color: #e5e7eb;
}

body.light .cookie-text p {
    color: #374151;
}

body.light .cookie-text a {
    color: #2563eb;
}

body.light .cookie-text a:hover {
    color: #1d4ed8;
}

body.light .cookie-decline {
    color: #6b7280;
    border-color: #d1d5db;
}

body.light .cookie-decline:hover {
    background: #f3f4f6;
    color: #374151;
}

@media (max-width: 768px) {
    .cookie-content {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }
    
    .cookie-text {
        min-width: auto;
    }
    
    .cookie-actions {
        justify-content: center;
    }
    
    .cookie-btn {
        flex: 1;
        max-width: 120px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cookieNotice = document.getElementById('cookie-notice');
    const acceptBtn = document.getElementById('cookie-accept');
    const declineBtn = document.getElementById('cookie-decline');
    
    // Проверяем, есть ли уже сохранённое согласие
    if (!localStorage.getItem('cookieConsent')) {
        setTimeout(() => {
            cookieNotice.style.display = 'block';
            setTimeout(() => cookieNotice.classList.add('show'), 100);
        }, 1000);
    }
    
    acceptBtn.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'accepted');
        hideNotice();
    });
    
    declineBtn.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'declined');
        hideNotice();
    });
    
    function hideNotice() {
        cookieNotice.classList.remove('show');
        setTimeout(() => {
            cookieNotice.style.display = 'none';
        }, 300);
    }
});
</script>

