// Обработчик формы заявок
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('application-form');
    const submitBtn = document.getElementById('submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    const successMessage = document.getElementById('success-message');
    const phoneInput = document.getElementById('phone');
    const consentCheckbox = document.getElementById('consent');
    const nameInput = document.getElementById('name');
    const messageInput = document.getElementById('message');
    const formStartedAt = document.getElementById('form_started_at');

    // Жестко зафиксировать ширину textarea с id message даже при инлайн-стилях
    if (messageInput) {
        try {
            messageInput.style.setProperty('width', '100%', 'important');
            messageInput.style.setProperty('min-width', '100%', 'important');
            messageInput.style.setProperty('max-width', '100%', 'important');
            messageInput.style.setProperty('box-sizing', 'border-box');
            messageInput.style.setProperty('resize', 'vertical', 'important');
            messageInput.style.setProperty('overflow-x', 'hidden');
        } catch(e) {}
    }

    // Маска для телефона
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Убираем все нецифровые символы
            
            if (value.length > 0) {
                if (value.startsWith('8')) {
                    value = '7' + value.slice(1);
                }
                
                if (value.startsWith('7')) {
                    if (value.length <= 1) {
                        value = '+7';
                    } else if (value.length <= 4) {
                        value = '+7 (' + value.slice(1);
                    } else if (value.length <= 7) {
                        value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4);
                    } else if (value.length <= 9) {
                        value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4, 7) + '-' + value.slice(7);
                    } else if (value.length <= 11) {
                        value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4, 7) + '-' + value.slice(7, 9) + '-' + value.slice(9);
                    } else {
                        value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4, 7) + '-' + value.slice(7, 9) + '-' + value.slice(9, 11);
                    }
                } else {
                    value = '+7 (' + value.slice(0, 3) + ') ' + value.slice(3, 6) + '-' + value.slice(6, 8) + '-' + value.slice(8, 10);
                }
            }
            
            e.target.value = value;
        });

        phoneInput.addEventListener('keydown', function(e) {
            // Разрешаем: backspace, delete, tab, escape, enter
            if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
                // Разрешаем: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (e.keyCode === 65 && e.ctrlKey === true) ||
                (e.keyCode === 67 && e.ctrlKey === true) ||
                (e.keyCode === 86 && e.ctrlKey === true) ||
                (e.keyCode === 88 && e.ctrlKey === true) ||
                // Разрешаем: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            // Убеждаемся, что это цифра и останавливаем keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        phoneInput.addEventListener('paste', function(e) {
            e.preventDefault();
            let paste = (e.clipboardData || window.clipboardData).getData('text');
            let value = paste.replace(/\D/g, '');
            
            if (value.length > 0) {
                if (value.startsWith('8')) {
                    value = '7' + value.slice(1);
                }
                
                if (value.startsWith('7') && value.length === 11) {
                    value = '+7 (' + value.slice(1, 4) + ') ' + value.slice(4, 7) + '-' + value.slice(7, 9) + '-' + value.slice(9, 11);
                    e.target.value = value;
                }
            }
        });
    }

    // Обработчик для очистки ошибки согласия
    if (consentCheckbox) {
        consentCheckbox.addEventListener('change', function() {
            if (this.checked) {
                this.classList.remove('error');
                const consentError = document.getElementById('consent-error');
                if (consentError) {
                    consentError.style.display = 'none';
                }
            }
        });
    }

    if (form) {
        // отметка времени открытия формы (для анти-бот проверки)
        if (formStartedAt && !formStartedAt.value) {
            formStartedAt.value = String(Date.now());
        }
        // Живая валидация: пересчет валидности на каждое изменение
        [nameInput, phoneInput, messageInput].forEach(function(el){ if (el) {
            // Во время ввода: очищаем ошибку и только обновляем состояние кнопки
            el.addEventListener('input', function(){
                clearFieldError(el.id);
            });
            // При уходе фокуса: валидируем поле и показываем ошибку, если есть
            function handleLeave(){
                const msg = validateField(el.id);
                if (msg) {
                    showErrors({ [el.id]: [msg] });
                } else {
                    clearFieldError(el.id);
                }
            }
            el.addEventListener('blur', handleLeave);
            el.addEventListener('focusout', handleLeave);
        }});
        if (consentCheckbox) {
            function validateConsent(){
                if (!consentCheckbox.checked) {
                    showConsentError();
                } else {
                    const ce = document.getElementById('consent-error');
                    if (ce) ce.style.display = 'none';
                    consentCheckbox.classList.remove('error');
                }
            }
            consentCheckbox.addEventListener('change', validateConsent);
            consentCheckbox.addEventListener('blur', validateConsent);
            consentCheckbox.addEventListener('focusout', validateConsent);
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Очистка предыдущих ошибок
            clearErrors();
            
            // Клиентская валидация полей
            const clientErrors = validateClientSide();
            if (Object.keys(clientErrors).length > 0) {
                showErrors(clientErrors);
                return;
            }
            
            // Клиентская валидация согласия
            const consentCheckbox = document.getElementById('consent');
            if (!consentCheckbox.checked) {
                showConsentError();
                return;
            }
            
            // Получение данных формы
            const formData = new FormData(form);
            
            // Показ состояния загрузки (временно блокируем, чтобы избежать двойной отправки)
            setLoadingState(true);
            
            // Отправка AJAX запроса
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                   document.querySelector('input[name="_token"]')?.value
                }
            })
            .then(response => response.json())
            .then(data => {
                setLoadingState(false);
                
                if (data.success) {
                    // Успешная отправка
                    showSuccess(data.message);
                    form.reset();
                    
                    // Закрытие модального окна через 2 секунды
                    setTimeout(() => {
                        const modal = document.querySelector('[data-modal]');
                        const modalOverlay = document.querySelector('[data-modal-overlay]');
                        if (modal && modalOverlay) {
                            modal.classList.remove('open');
                            modalOverlay.classList.remove('active');
                            document.body.style.overflow = '';
                        }
                    }, 2000);
                } else {
                    // Ошибки валидации
                    if (data.errors) {
                        showErrors(data.errors);
                    } else {
                        showError(data.message || 'Произошла ошибка при отправке заявки');
                    }
                }
            })
            .catch(error => {
                setLoadingState(false);
                console.error('Error:', error);
                showError('Произошла ошибка при отправке заявки. Проверьте подключение к интернету.');
            });
        });
    }

    // Очистка ошибок по вводу/уходу фокуса
    attachRealtimeValidation('name');
    attachRealtimeValidation('phone');
    attachRealtimeValidation('message');

    function setLoadingState(loading) {
        if (loading) {
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline';
        } else {
            // Возвращаем возможность нажать кнопку
            submitBtn.disabled = false;
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
        }
    }


    function clearFieldError(fieldId) {
        const errorEl = document.getElementById(fieldId + '-error');
        const inputEl = document.getElementById(fieldId);
        if (errorEl) { errorEl.textContent = ''; errorEl.style.display = 'none'; }
        if (inputEl) { inputEl.classList.remove('error'); }
    }

    function validateField(fieldId) {
        if (fieldId === 'name') {
            const nameInput = document.getElementById('name');
            const name = (nameInput && nameInput.value ? nameInput.value : '').trim();
            if (!name) return 'Поле "Имя" обязательно для заполнения';
            if (name.length > 255) return 'Имя не должно превышать 255 символов';
            const nameRe = /^[A-Za-zА-Яа-яЁё\-\'\s]+$/;
            if (!nameRe.test(name)) return 'Имя может содержать только буквы, пробелы, дефис и апостроф';
            return '';
        }
        if (fieldId === 'phone') {
            const phoneInput = document.getElementById('phone');
            const digits = (phoneInput && phoneInput.value ? phoneInput.value : '').replace(/\D/g, '');
            if (!digits) return 'Поле "Телефон" обязательно для заполнения';
            if (digits.length !== 11) return 'Введите корректный номер телефона (+7 (XXX) XXX-XX-XX)';
            if (digits[0] !== '7') return 'Телефон должен начинаться с +7';
            if ((phoneInput && phoneInput.value ? phoneInput.value.length : 0) > 20) return 'Телефон не должен превышать 20 символов';
            return '';
        }
        if (fieldId === 'message') {
            const messageInput = document.getElementById('message');
            const message = messageInput && messageInput.value ? messageInput.value : '';
            if (message.length > 1000) return 'Сообщение не должно превышать 1000 символов';
            return '';
        }
        return '';
    }

    function attachRealtimeValidation(fieldId) {
        const input = document.getElementById(fieldId);
        const errorEl = document.getElementById(fieldId + '-error');
        if (!input || !errorEl) return;
        const clear = function(){ errorEl.textContent = ''; errorEl.style.display = 'none'; input.classList.remove('error'); };
        input.addEventListener('input', clear);
        input.addEventListener('blur', clear);
    }

    function clearErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(el => {
            el.textContent = '';
            el.style.display = 'none';
        });
        
        const inputElements = document.querySelectorAll('input, textarea');
        inputElements.forEach(input => {
            input.classList.remove('error');
        });
        
        // Очистка стилей для checkbox
        const consentCheckbox = document.getElementById('consent');
        if (consentCheckbox) {
            consentCheckbox.classList.remove('error');
        }
    }

    function validateClientSide() {
        const errors = {};
        const nameInput = document.getElementById('name');
        const phoneInput = document.getElementById('phone');
        const messageInput = document.getElementById('message');

        // name
        if (nameInput) {
            const name = (nameInput.value || '').trim();
            if (!name) {
                errors['name'] = ['Поле "Имя" обязательно для заполнения'];
            } else if (name.length > 255) {
                errors['name'] = ['Имя не должно превышать 255 символов'];
            } else {
                const nameRe = /^[A-Za-zА-Яа-яЁё\-\'\s]+$/;
                if (!nameRe.test(name)) {
                    errors['name'] = ['Имя может содержать только буквы, пробелы, дефис и апостроф'];
                }
            }
        }

        // phone
        if (phoneInput) {
            const digits = (phoneInput.value || '').replace(/\D/g, '');
            if (!digits) {
                errors['phone'] = ['Поле "Телефон" обязательно для заполнения'];
            } else if (digits.length !== 11) {
                errors['phone'] = ['Введите корректный номер телефона (+7 (XXX) XXX-XX-XX)'];
            } else if (digits[0] !== '7') {
                errors['phone'] = ['Телефон должен начинаться с +7'];
            } else if (phoneInput.value.length > 20) {
                errors['phone'] = ['Телефон не должен превышать 20 символов'];
            }
        }

        // message
        if (messageInput) {
            const message = messageInput.value || '';
            if (message.length > 1000) {
                errors['message'] = ['Сообщение не должно превышать 1000 символов'];
            }
        }

        // consent unified into errors for consistency (UI also highlights separately)
        const consentCheckbox = document.getElementById('consent');
        if (consentCheckbox && !consentCheckbox.checked) {
            errors['consent'] = ['Необходимо согласие на обработку персональных данных'];
        }

        return errors;
    }

    function showErrors(errors) {
        Object.keys(errors).forEach(field => {
            const errorElement = document.getElementById(field + '-error');
            const inputElement = document.getElementById(field);
            
            if (errorElement) {
                errorElement.textContent = Array.isArray(errors[field]) ? errors[field][0] : String(errors[field]);
                errorElement.style.display = 'block';
            }
            
            if (inputElement) {
                inputElement.classList.add('error');
            }
        });
    }

    function showError(message) {
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message global-error';
        errorElement.textContent = message;
        errorElement.style.display = 'block';
        errorElement.style.marginTop = '10px';
        errorElement.style.color = '#ff6b6b';
        errorElement.style.textAlign = 'center';
        
        form.appendChild(errorElement);
        
        // Удаление ошибки через 5 секунд
        setTimeout(() => {
            if (errorElement.parentNode) {
                errorElement.parentNode.removeChild(errorElement);
            }
        }, 5000);
    }

    function showSuccess(message) {
        successMessage.textContent = message;
        successMessage.style.display = 'block';
        successMessage.style.color = '#4caf50';
        successMessage.style.textAlign = 'center';
        successMessage.style.marginTop = '10px';
        successMessage.style.padding = '10px';
        successMessage.style.backgroundColor = 'rgba(76, 175, 80, 0.1)';
        successMessage.style.borderRadius = '5px';
        successMessage.style.border = '1px solid rgba(76, 175, 80, 0.3)';
        
        // Скрытие сообщения через 5 секунд
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000);
    }

    function showConsentError() {
        const consentCheckbox = document.getElementById('consent');
        const consentError = document.getElementById('consent-error');
        
        if (consentCheckbox) {
            consentCheckbox.classList.add('error');
        }
        
        if (consentError) {
            consentError.textContent = 'Необходимо согласие на обработку персональных данных';
            consentError.style.display = 'block';
        }
    }
});
