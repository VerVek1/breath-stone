<div class="application-details">
    <div class="application-header">
        <h2>Заявка #{{ $client->id }}</h2>
        <div class="application-status">
            <span class="status-badge status-{{ $client->status }}">
                @switch($client->status)
                    @case('new')
                        Новая
                        @break
                    @case('contacted')
                        Связались
                        @break
                    @case('processed')
                        В работе
                        @break
                    @case('completed')
                        Завершена
                        @break
                @endswitch
            </span>
        </div>
    </div>

    <div class="application-info">
        <div class="info-section">
            <h3>Контактная информация</h3>
            <div class="info-grid">
                <div class="info-item">
                    <label>Имя:</label>
                    <span>{{ $client->name }}</span>
                </div>
                <div class="info-item">
                    <label>Телефон:</label>
                    <span>
                        <a href="tel:{{ $client->phone }}" class="contact-link">{{ $client->phone }}</a>
                    </span>
                </div>
            </div>
        </div>

        @if($client->message)
        <div class="info-section">
            <h3>Сообщение</h3>
            <div class="message-content">
                {{ $client->message }}
            </div>
        </div>
        @endif

        <div class="info-section">
            <h3>Информация о заявке</h3>
            <div class="info-grid">
                <div class="info-item">
                    <label>Дата создания:</label>
                    <span>{{ $client->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <label>Последнее обновление:</label>
                    <span>{{ $client->updated_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="application-actions">
        <button class="btn btn-primary" onclick="callClient('{{ $client->phone }}')">
            <i class="fa-solid fa-phone"></i> Позвонить
        </button>
        <button class="btn btn-danger" onclick="deleteApplication({{ $client->id }})">
            <i class="fa-solid fa-trash"></i> Удалить
        </button>
    </div>
</div>

<script>
function callClient(phone) {
    window.open(`tel:${phone}`, '_self');
}
</script>
