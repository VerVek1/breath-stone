<section id="advantages" class="advantages-section">
    <div class="container">
        <div class="advantages-header">
            <h2>Преимущества искусственного камня</h2>
            <p>Почему искусственный камень - идеальное решение для вашего интерьера</p>
        </div>
        <div class="advantages-grid">
            @foreach ([
                ['fa-shield-halved','Гигиеничность','Отсутствие пор препятствует размножению бактерий'],
                ['fa-temperature-high','Термостойкость','Выдерживает температуру до 200°C'],
                ['fa-screwdriver-wrench','Ремонтопригодность','Царапины и повреждения легко устраняются'],
                ['fa-grip-lines','Бесшовность','Идеальная поверхность без стыков'],
                ['fa-leaf','Экологичность','Безопасен для пищевого контакта'],
                ['fa-flask','Устойчивость к кислотам','Не повреждается агрессивными веществами'],
                ['fa-broom','Легкий уход','Простота в очистке и обслуживании'],
                ['fa-droplet','Не впитывают грязь','Поверхность остается чистой и гигиеничной'],
                ['fa-shield','Износостойкость','Долго сохраняет первоначальный вид'],
                ['fa-hammer','Ударопрочность','Устойчив к механическим повреждениям'],
            ] as [$icon,$title,$text])
            <div class="advantage-card">
                <div class="advantage-icon-bg"><div class="advantage-icon"><i class="fa-solid {{$icon}}" aria-hidden="true"></i></div></div>
                <h3>{{$title}}</h3>
                <p>{{$text}}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>






















