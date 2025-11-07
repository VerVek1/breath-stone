<div class="modal-overlay" data-modal-overlay></div>
<div class="modal" data-modal>
    <div class="modal-header no-title">
        <button class="modal-close" aria-label="Закрыть" data-modal-close>&times;</button>
    </div>
    <div class="modal-body">
        <div class="order-header">
            <h2>Как заказать изделия из камня в Московской области?</h2>
            <p>Мы работаем во всех районах Московской области: Балашиха, Химки, Королёв, Мытищи, Люберцы, Красногорск и другие.</p>
        </div>
        <div class="order-layout">
            <aside class="order-aside">
                <div class="order-promo" aria-label="Акция">
                    <h3>Акция!</h3>
                    <p>При заказе столешницы от 2м² — скидка 5000₽ на каменные мойки.</p>
                </div>
                <div class="order-promo form-info" role="note">
                    <h3>Быстрая связь</h3>
                    <p>Оставьте заявку — мы перезвоним в рабочее время, уточним детали и поможем с расчётом. Не хотите ждать? Звоните прямо сейчас:</p>
                    <ul class="form-contacts">
                        <li><a href="tel:+79250238723">8 (925) 023-87-23</a></li>
                        <li><a href="tel:+79266600219">8 (926) 660-02-19</a></li>
                    </ul>
                </div>
            </aside>
            <div class="order-form">
                <div class="contact-form">
                    <form id="application-form" method="POST" action="{{ route('application.submit') }}">
                        @csrf
                        {{-- Honeypot + timing fields to mitigate bots --}}
                        <input type="text" name="website" id="website" value="" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute;left:-9999px;opacity:0;height:0;width:0;" />
                        <input type="hidden" name="form_started_at" id="form_started_at" value="" />
                        <div class="form-group">
                            <label for="name">Ваше имя *</label>
                            <input type="text" id="name" name="name" placeholder="Иван Иванов" required>
                            <div class="error-message" id="name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон *</label>
                            <input type="tel" id="phone" name="phone" placeholder="+7 (999) 123-45-67" maxlength="18" required>
                            <div class="error-message" id="phone-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="message">Сообщение</label>
                            <textarea id="message" name="message" placeholder="Опишите, что вы хотите заказать и когда вам будет удобно говорить"></textarea>
                            <div class="error-message" id="message-error"></div>
                        </div>
                        <div class="consent-block">
                            <label class="checkbox-label">
                                <input type="checkbox" name="consent" id="consent" required>
                                <span class="checkmark"></span>
                                <span class="consent-text">
                                    Я согласен на обработку <a href="{{ route('privacy.policy') }}" target="_blank">персональных данных</a> 
                                    и принимаю условия <a href="{{ route('user.agreement') }}" target="_blank">пользовательского соглашения</a>
                                </span>
                            </label>
                            <div class="error-message" id="consent-error"></div>
                        </div>
                        <button type="submit" class="btn btn-block" id="submit-btn">
                            <span class="btn-text">Оставить заявку</span>
                            <span class="btn-loading" style="display: none;">Отправка...</span>
                        </button>
                        <div class="success-message" id="success-message" style="display: none;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



