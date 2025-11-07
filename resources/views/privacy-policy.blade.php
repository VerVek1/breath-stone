@extends('layouts.app')
@section('title', 'Политика обработки персональных данных | Breath Stone')
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
            <h1>Политика обработки персональных данных</h1>
            <p class="legal-subtitle">Breath Stone - Изделия из камня</p>
        </div>

        <div class="legal-content">
            <div class="legal-images">
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0001-1.jpg') }}" alt="Политика обработки персональных данных - Страница 1" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0002.jpg') }}" alt="Политика обработки персональных данных - Страница 2" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0003.jpg') }}" alt="Политика обработки персональных данных - Страница 3" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0004.jpg') }}" alt="Политика обработки персональных данных - Страница 4" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0005.jpg') }}" alt="Политика обработки персональных данных - Страница 5" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0006.jpg') }}" alt="Политика обработки персональных данных - Страница 6" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0007.jpg') }}" alt="Политика обработки персональных данных - Страница 7" class="policy-image">
                </div>
                <div class="legal-image">
                    <img src="{{ url('/images/privacy-policy/privacy_page-0008-1.jpg') }}" alt="Политика обработки персональных данных - Страница 8" class="policy-image">
                </div>
            </div>
        </div>
        
        <div class="pdf-viewer-section">
            <div class="pdf-container">
                <h3>Дополнительный документ</h3>
                <p>Дополнительная информация в формате PDF:</p>
                
                <div class="pdf-viewer-container">
                    <iframe 
                        src="{{ url('/images/privacy-policy/Портал_персональных_данных_Форма_уведомления_Неясов.pdf') }}#toolbar=0&navpanes=0&scrollbar=1&view=FitH"
                        class="pdf-viewer"
                        title="Политика обработки персональных данных PDF">
                        <p>Ваш браузер не поддерживает встроенный просмотр PDF. 
                           <a href="{{ url('/images/privacy-policy/Портал_персональных_данных_Форма_уведомления_Неясов.pdf') }}" 
                              target="_blank" 
                              class="pdf-fallback-link">
                               Открыть PDF в новом окне
                           </a>
                        </p>
                    </iframe>
                </div>
                
                <div class="pdf-actions">
                    <a href="{{ url('/images/privacy-policy/Портал_персональных_данных_Форма_уведомления_Неясов.pdf') }}" 
                       target="_blank" 
                       class="pdf-download-btn">
                        <i class="fas fa-download"></i>
                        Скачать PDF
                    </a>
                    <a href="{{ url('/images/privacy-policy/Портал_персональных_данных_Форма_уведомления_Неясов.pdf') }}" 
                       target="_blank" 
                       class="pdf-open-btn">
                        <i class="fas fa-external-link-alt"></i>
                        Открыть в новом окне
                    </a>
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

.legal-section p {
    margin-bottom: 15px;
    color: #ccc;
}

.legal-section ul {
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

.pdf-viewer-section {
    margin-top: 40px;
    padding: 30px 0;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.pdf-container {
    text-align: center;
    max-width: 900px;
    margin: 0 auto;
    padding: 0 20px;
}

.pdf-container h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #fff;
}

.pdf-container p {
    font-size: 1rem;
    color: #ccc;
    margin-bottom: 25px;
    line-height: 1.6;
}

.pdf-viewer-container {
    width: 100%;
    height: 600px;
    margin-bottom: 25px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.pdf-viewer {
    width: 100%;
    height: 100%;
    border: none;
    background: #fff;
}

.pdf-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.pdf-download-btn,
.pdf-open-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.pdf-download-btn {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: #fff;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.pdf-download-btn:hover {
    background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    color: #fff;
}

.pdf-open-btn {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.pdf-open-btn:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
    color: #fff;
}

.pdf-download-btn i,
.pdf-open-btn i {
    font-size: 1.1rem;
}

.pdf-fallback-link {
    color: #dc3545;
    text-decoration: underline;
    font-weight: 600;
}

.pdf-fallback-link:hover {
    color: #c82333;
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

body.light .legal-section h2 {
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

body.light .pdf-viewer-section {
    background: #ffffff;
    border-color: #e7e7ea;
}

body.light .pdf-container h3 {
    color: #111;
}

body.light .pdf-container p {
    color: #444;
}

body.light .pdf-viewer-container {
    border-color: #e7e7ea;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

body.light .pdf-open-btn {
    background: #f8f9fa;
    color: #111;
    border-color: #e7e7ea;
}

body.light .pdf-open-btn:hover {
    background: #e9ecef;
    color: #111;
}

body.light .pdf-fallback-link {
    color: #dc3545;
}

body.light .pdf-fallback-link:hover {
    color: #c82333;
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
    
    .legal-images {
        gap: 0;
    }
    
    .legal-image {
        margin-bottom: 0;
    }
    
    .policy-image {
        border-radius: 0;
    }
    
    .pdf-viewer-section {
        margin-top: 30px;
        padding: 20px 0;
    }
    
    .pdf-container {
        padding: 0 15px;
    }
    
    .pdf-container h3 {
        font-size: 1.3rem;
    }
    
    .pdf-container p {
        font-size: 0.9rem;
    }
    
    .pdf-viewer-container {
        height: 400px;
        margin-bottom: 20px;
    }
    
    .pdf-actions {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    
    .pdf-download-btn,
    .pdf-open-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
}
</style>
@endsection
