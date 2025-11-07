@extends('layouts.app')
@section('title', 'Политика использования файлов cookie | Breath Stone')
@section('meta')
<meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
<div class="legal-page">
    <div class="legal-container">
        <a href="{{ url('/') }}" class="legal-back-link" onclick="if (document.referrer) { history.back(); return false; }">
            ← Назад
        </a>
        <div class="legal-header">
            <h1>Политика использования файлов cookie</h1>
            <p class="legal-subtitle">Breath Stone - Изделия из камня</p>
        </div>

        <div class="legal-content">
            <div class="legal-images">
                <div class="legal-image">
                    <img src="{{ url('/images/cookie/cookie_page-0001.jpg') }}" alt="Политика использования cookie - Страница 1" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/cookie/cookie_page-0002.jpg') }}" alt="Политика использования cookie - Страница 2" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/cookie/cookie_page-0003.jpg') }}" alt="Политика использования cookie - Страница 3" class="policy-image">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.legal-page {
    background: #111;
    color: #f5f5f5;
    min-height: 100vh;
    padding: 40px 0;
}

.legal-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    padding: 10px 14px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    color: #fff;
    text-decoration: none;
    transition: all .2s ease;
}
.legal-back-link:hover {
    background: rgba(255,255,255,0.08);
    transform: translateY(-1px);
}

/* Light theme overrides */
body.light .legal-back-link {
    background: #f8f9fa;
    border-color: #e7e7ea;
    color: #111;
}
body.light .legal-back-link:hover {
    background: #f1f3f5;
}

.legal-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.legal-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 1px solid #333;
}

.legal-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.legal-subtitle {
    font-size: 1.1rem;
    color: #bbb;
    margin: 0;
}

.legal-content {
    line-height: 1.6;
}

.legal-images {
    display: flex;
    flex-direction: column;
    gap: 0;
    align-items: center;
}

.legal-image {
    width: 100%;
    max-width: 800px;
    margin-bottom: 0;
}

.policy-image {
    width: 100%;
    height: auto;
    border-radius: 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.policy-image:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
}

/* Light theme */
body.light .legal-page {
    background: #f8f9fa;
    color: #111;
}

body.light .legal-header {
    border-bottom: 1px solid #e0e0e0;
}

body.light .legal-header h1 {
    background: linear-gradient(135deg, #111 0%, #333 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

body.light .legal-subtitle {
    color: #666;
}

body.light .policy-image {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}
body.light .policy-image:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .legal-container { padding: 0 15px; }
    .legal-header h1 { font-size: 2rem; }
}
</style>
@endsection



