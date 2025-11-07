@extends('layouts.app')
@section('title', 'Пользовательское соглашение | Breath Stone')
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
            <h1>Пользовательское соглашение</h1>
            <p class="legal-subtitle">Breath Stone - Изделия из камня</p>
        </div>

        <div class="legal-content">
            <div class="legal-images">
                <div class="legal-image">
                    <img src="{{ url('/images/user-agreement/agreement_page-0001.jpg') }}" alt="Пользовательское соглашение - Страница 1" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/user-agreement/agreement_page-0002.jpg') }}" alt="Пользовательское соглашение - Страница 2" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/user-agreement/agreement_page-0003.jpg') }}" alt="Пользовательское соглашение - Страница 3" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/user-agreement/agreement_page-0004.jpg') }}" alt="Пользовательское соглашение - Страница 4" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/user-agreement/agreement_page-0005.jpg') }}" alt="Пользовательское соглашение - Страница 5" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/user-agreement/agreement_page-0006.jpg') }}" alt="Пользовательское соглашение - Страница 6" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/user-agreement/agreement_page-0007.jpg') }}" alt="Пользовательское соглашение - Страница 7" class="policy-image">
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

.legal-section {
    margin-bottom: 30px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.legal-section h2 {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #fff;
    border-bottom: 1px solid #333;
    padding-bottom: 8px;
}

.legal-section h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 20px 0 10px 0;
    color: #fff;
}

.legal-section p {
    margin-bottom: 15px;
    color: #ccc;
}

.legal-section ul, .legal-section ol {
    margin: 15px 0;
    padding-left: 20px;
}

.legal-section li {
    margin-bottom: 8px;
    color: #ccc;
}

.legal-section a {
    color: #fff;
    text-decoration: underline;
    transition: color 0.2s ease;
}

.legal-section a:hover {
    color: #bbb;
}

.legal-footer {
    margin-top: 40px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.legal-footer p {
    margin: 0;
    color: #bbb;
}

/* Light theme */
body.light .legal-page {
    background: #f8f9fa;
    color: #111;
}

body.light .legal-header {
    border-bottom-color: #dee2e6;
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

body.light .legal-section {
    background: #ffffff;
    border-color: #e7e7ea;
}

body.light .legal-section h2,
body.light .legal-section h3 {
    color: #111;
    border-bottom-color: #dee2e6;
}

body.light .legal-section p,
body.light .legal-section li {
    color: #444;
}

body.light .legal-section a {
    color: #111;
}

body.light .legal-section a:hover {
    color: #666;
}

body.light .legal-footer {
    background: #f8f9fa;
    border-color: #e7e7ea;
}

body.light .legal-footer p {
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
    .legal-container {
        padding: 0 15px;
    }
    
    .legal-header h1 {
        font-size: 2rem;
    }
    
    .legal-section {
        padding: 15px;
    }
    
    .legal-section h2 {
        font-size: 1.2rem;
    }
    
    .legal-section h3 {
        font-size: 1rem;
    }

    .legal-images {
        gap: 0;
    }
    
    .legal-image {
        margin-bottom: 0;
    }
    
    .policy-image {
        border-radius: 0;
    }
}
</style>
@endsection
