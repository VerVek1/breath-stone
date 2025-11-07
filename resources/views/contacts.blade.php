@extends('layouts.app')
@section('title','Контакты | Breath Stone')
@section('meta')
<meta name="description" content="Контакты Breath Stone в Москве и Московской области. Офис в Мытищах, производство в Монино. Телефоны, адреса, график работы. Звоните: +7 (926) 660-02-19.">
<link rel="canonical" href="{{ url()->current() }}">
@endsection
@section('content')
@include('partials.header')
<main class="container" style="padding: 40px 24px;">
    <h1>Контакты</h1>
    <section class="contacts-section">
        <div class="contacts-grid">
            <div class="contacts-cards">
                <div class="contact-card">
                    <h3>Офис (Мытищи)</h3>
                    <ul class="contact-list">
                        <li>адрес: г. Мытищи, улица Мира, 26А</li>
                        <li>Пн–Вс: 09:00 – 20:00</li>
                        <li>телефон: <a href="tel:+79250238723">8 (925) 023-87-23</a></li>
                        <li>телефон: <a href="tel:+79266600219">8 (926) 660-02-19</a></li>
                        <li>эл. почта: <a href="mailto:breath-stone@yandex.ru">breath-stone@yandex.ru</a></li>
                    </ul>
                </div>
                <div class="contact-card">
                    <h3>Производство (Монино)</h3>
                    <ul class="contact-list">
                        <li>адрес: г. Монино, улица Южная, 5А</li>
                        <li>Пн–Вс: 09:00 – 20:00</li>
                        <li>телефон: <a href="tel:+79266600219">8 (926) 660-02-19</a></li>
                    </ul>
                </div>
            </div>
            <div class="map-card" style="grid-column: 1 / -1;">
                <div class="map-header"><h3>Мы на карте</h3></div>
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A9de54e3cf183d57cf15b4c6d298b6cdded2bb460aadc3990d1a1451977c6fe46&amp;width=1150&amp;height=540&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </div>
    </section>

    <section class="cooperation-section" style="margin-top: 60px;">
        <h2>Сотрудничество</h2>
        <div class="cooperation-content">
            <div class="cooperation-contact">
                <p>Консультации и дополнительную информацию об условиях сотрудничества вы можете получить у Петра Неясова, руководителя проектного направления:</p>
                <ul class="contact-list">
                    <li>тел.: <a href="tel:+79266600219">+7(926)660-02-19</a></li>
                    <li>e-mail: <a href="mailto:neyasov86@inbox.ru">neyasov86@inbox.ru</a></li>
                </ul>
            </div>
            
            <div class="cooperation-description">
                <p>Breath Stone приглашает к сотрудничеству проектные компании, архитектурные мастерские, дизайн-студии, а также строительные компании и девелоперов.</p>
                
                <p>Мы открыты для взаимовыгодного сотрудничества со всеми, кто проявляет интерес к искусственному камню.</p>
                
                <p>Архитекторы и дизайнеры смогут найти в наших коллекциях материал, который сделает их проект ярким и единственным в своем роде.</p>
                
                <p>Изготовителям мебели мы предлагаем искусственный камень мировых брендов для столешниц, полок, раковин и моек.</p>
                
                <p>Мебельные салоны расширят свои возможности и ассортимент, демонстрируя клиентам уникальные интерьеры, созданные с использованием нашего камня.</p>
                
                <p><strong>Мы на шаг ближе к нашим клиентам и партнерам, чем другие:</strong></p>
                
                <p>Мы рады сотрудничеству, всегда доступны, внимательны и терпеливы. С нами легко, потому что мы лояльны и готовы к диалогу.</p>
            </div>
        </div>
    </section>
</main>
@endsection




