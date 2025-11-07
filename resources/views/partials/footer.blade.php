<footer id="contacts">
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>Контакты</h3>
                <p>Московская обл., Мытищи</p>
                <p>Телефон: <a href="tel:+79266600219">+7 (926) 660-02-19</a></p>
                <p>Email: <a href="mailto:breath-stone@yandex.ru">breath-stone@yandex.ru</a></p>
            </div>
            <div class="footer-column">
                <h3>О компании</h3>
                <ul>
                    <li><a href="{{ url('https://www.avito.ru/brands/breathstone/all') }}" target="_blank" rel="noopener noreferrer">Отзывы</a></li>
                    <li><a href="{{ url('https://www.avito.ru/brands/breathstone/all') }}" target="_blank" rel="noopener noreferrer">Портфолио</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Ссылки</h3>
                <ul>
                    <li><a href="{{ route('privacy.policy') }}">Политика конфиденциальности</a></li>
                    <li><a href="{{ route('user.agreement') }}">Пользовательское соглашение</a></li>
                    <li><a href="{{ route('cookie.policy') }}">Политика cookie</a></li>
                </ul>
            </div>
        </div>
       
        <div class="copyright">
            <p>© {{ now('Europe/Moscow')->year }} Breath Stone. Все права защищены. <br>Разрешается использовать любые материалы проекта BREATHSTONE.RU в сети Интернет при условии установки прямой ссылки на этот конкретный материал.</p>
            
        </div>
    </div>
</footer>













