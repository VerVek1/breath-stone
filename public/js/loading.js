// Loading Screen Management
document.addEventListener('DOMContentLoaded', function() {
    const loadingScreen = document.getElementById('loading-screen');
    
    // Функция для скрытия окна загрузки
    function hideLoadingScreen() {
        if (loadingScreen) {
            loadingScreen.classList.add('hidden');
            // Удаляем элемент из DOM после анимации
            setTimeout(() => {
                if (loadingScreen.parentNode) {
                    loadingScreen.parentNode.removeChild(loadingScreen);
                }
            }, 500); // Время должно совпадать с CSS transition
        }
    }
    
    // Проверяем, загружена ли страница полностью
    function checkPageLoaded() {
        // Проверяем состояние загрузки документа
        if (document.readyState === 'complete') {
            // Дополнительная задержка для плавности
            setTimeout(hideLoadingScreen, 500);
        } else {
            // Если страница еще не загружена, ждем события load
            window.addEventListener('load', function() {
                setTimeout(hideLoadingScreen, 500);
            });
        }
    }
    
    // Проверяем загрузку всех ресурсов
    window.addEventListener('load', function() {
        // Ждем загрузки всех изображений
        const images = document.querySelectorAll('img');
        let loadedImages = 0;
        
        if (images.length === 0) {
            // Если изображений нет, скрываем экран загрузки сразу
            setTimeout(hideLoadingScreen, 500);
            return;
        }
        
        images.forEach(function(img) {
            if (img.complete) {
                loadedImages++;
            } else {
                img.addEventListener('load', function() {
                    loadedImages++;
                    if (loadedImages === images.length) {
                        setTimeout(hideLoadingScreen, 500);
                    }
                });
                img.addEventListener('error', function() {
                    loadedImages++;
                    if (loadedImages === images.length) {
                        setTimeout(hideLoadingScreen, 500);
                    }
                });
            }
        });
        
        // Если все изображения уже загружены
        if (loadedImages === images.length) {
            setTimeout(hideLoadingScreen, 500);
        }
    });
    
    // Резервный таймер на случай, если что-то пойдет не так
    setTimeout(function() {
        if (loadingScreen && !loadingScreen.classList.contains('hidden')) {
            hideLoadingScreen();
        }
    }, 10000); // Максимум 10 секунд
    
    // Начальная проверка
    checkPageLoaded();
});


