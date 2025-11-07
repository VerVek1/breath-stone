@extends('layouts.app')
@section('title', 'Заявки | Админ-панель')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Заявки клиентов</h1>
        <div class="admin-stats">
            <div class="stat-card">
                <span class="stat-number">{{ $stats['total'] }}</span>
                <span class="stat-label">Всего заявок</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $stats['new'] }}</span>
                <span class="stat-label">Новых</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $stats['contacted'] }}</span>
                <span class="stat-label">Связались</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $stats['processed'] }}</span>
                <span class="stat-label">В работе</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $stats['completed'] }}</span>
                <span class="stat-label">Завершено</span>
            </div>
        </div>
    </div>

    <!-- Фильтры -->
    <div class="filters-container">
        <form method="GET" action="{{ route('admin.applications.index') }}" class="filters-form" id="filters-form">
            <div class="filters-row">
                <div class="filter-group">
                    <label for="search">Поиск</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Имя, телефон, email...">
                </div>
                
                <div class="filter-group">
                    <label for="status">Статус</label>
                    <select id="status" name="status">
                        <option value="">Все статусы</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>Новая</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Связались</option>
                        <option value="processed" {{ request('status') === 'processed' ? 'selected' : '' }}>В работе</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Завершена</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="date_from">Дата от</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}">
                </div>
                
                <div class="filter-group">
                    <label for="date_to">Дата до</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}">
                </div>
                
                <div class="filter-group">
                    <label for="sort_by">Сортировка</label>
                    <select id="sort_by" name="sort_by">
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>По дате</option>
                        <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>По имени</option>
                        <option value="status" {{ request('sort_by') === 'status' ? 'selected' : '' }}>По статусу</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="sort_order">Порядок</label>
                    <select id="sort_order" name="sort_order">
                        <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>По убыванию</option>
                        <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>По возрастанию</option>
                    </select>
                </div>
            </div>
            
            <div class="filters-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-search"></i> Применить
                </button>
                <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-times"></i> Сбросить
                </a>
            </div>
        </form>
    </div>

    <div class="applications-table-container">
        <table class="applications-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr class="application-row" data-id="{{ $client->id }}">
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>
                        <a href="tel:{{ $client->phone }}" class="phone-link">{{ $client->phone }}</a>
                    </td>
                    <td>
                        <select class="status-select" data-client-id="{{ $client->id }}" data-current-status="{{ $client->status }}">
                            <option value="new" {{ $client->status === 'new' ? 'selected' : '' }}>Новая</option>
                            <option value="contacted" {{ $client->status === 'contacted' ? 'selected' : '' }}>Связались</option>
                            <option value="processed" {{ $client->status === 'processed' ? 'selected' : '' }}>В работе</option>
                            <option value="completed" {{ $client->status === 'completed' ? 'selected' : '' }}>Завершена</option>
                        </select>
                    </td>
                    <td>{{ $client->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-view" onclick="viewApplication({{ $client->id }})" title="Просмотр">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-delete" onclick="deleteApplication({{ $client->id }})" title="Удалить">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="no-data">Заявки не найдены</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($clients->hasPages())
    <div class="pagination-container">
        {{ $clients->links() }}
    </div>
    @endif
</div>

<!-- Модальное окно для просмотра заявки -->
<div id="application-modal" class="modal-overlay" style="display: none;">
    <div class="modal" style="max-width: 600px;">
        <div class="modal-header">
            <h3>Детали заявки</h3>
            <button class="modal-close" onclick="closeApplicationModal()">&times;</button>
        </div>
        <div class="modal-body" id="application-details">
            <!-- Содержимое будет загружено через AJAX -->
        </div>
    </div>
</div>

<script>
// Изменение статуса заявки
document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('.status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const clientId = this.dataset.clientId;
            const newStatus = this.value;
            const currentStatus = this.dataset.currentStatus;
            
            if (newStatus === currentStatus) return;
            
            // Показываем индикатор загрузки
            this.disabled = true;
            
            fetch(`/admin/applications/${clientId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.dataset.currentStatus = newStatus;
                    showNotification('Статус обновлен', 'success');
                } else {
                    this.value = currentStatus;
                    showNotification('Ошибка при обновлении статуса', 'error');
                }
            })
            .catch(error => {
                this.value = currentStatus;
                showNotification('Ошибка при обновлении статуса', 'error');
            })
            .finally(() => {
                this.disabled = false;
            });
        });
    });
});

// Просмотр заявки
function viewApplication(clientId) {
    const modal = document.getElementById('application-modal');
    const details = document.getElementById('application-details');
    
    details.innerHTML = '<div class="loading">Загрузка...</div>';
    modal.style.display = 'flex';
    
    fetch(`/admin/applications/${clientId}`)
        .then(response => response.text())
        .then(html => {
            // Извлекаем только содержимое модального окна
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const modalContent = doc.querySelector('.application-details');
            details.innerHTML = modalContent ? modalContent.innerHTML : 'Ошибка загрузки';
        })
        .catch(error => {
            details.innerHTML = '<div class="error">Ошибка при загрузке данных</div>';
        });
}

// Закрытие модального окна
function closeApplicationModal() {
    document.getElementById('application-modal').style.display = 'none';
}

// Удаление заявки
function deleteApplication(clientId) {
    if (!confirm('Вы уверены, что хотите удалить эту заявку?')) {
        return;
    }
    
    fetch(`/admin/applications/${clientId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`tr[data-id="${clientId}"]`).remove();
            showNotification('Заявка удалена', 'success');
        } else {
            showNotification('Ошибка при удалении заявки', 'error');
        }
    })
    .catch(error => {
        showNotification('Ошибка при удалении заявки', 'error');
    });
}

// Показ уведомлений
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Закрытие модального окна по клику на overlay
document.getElementById('application-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeApplicationModal();
    }
});


// Автосохранение фильтров в localStorage
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filters-form');
    const inputs = form.querySelectorAll('input, select');
    
    // Загружаем сохраненные фильтры
    const savedFilters = localStorage.getItem('applications_filters');
    if (savedFilters && !window.location.search) {
        try {
            const filters = JSON.parse(savedFilters);
            Object.keys(filters).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    input.value = filters[key];
                }
            });
        } catch (e) {
            console.log('Ошибка загрузки сохраненных фильтров');
        }
    }
    
    // Сохраняем фильтры при изменении
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const formData = new FormData(form);
            const filters = {};
            for (let [key, value] of formData.entries()) {
                if (value) {
                    filters[key] = value;
                }
            }
            localStorage.setItem('applications_filters', JSON.stringify(filters));
        });
    });
    
    // Автоотправка формы при изменении некоторых полей
    const autoSubmitFields = ['status', 'sort_by', 'sort_order'];
    autoSubmitFields.forEach(fieldName => {
        const field = form.querySelector(`[name="${fieldName}"]`);
        if (field) {
            field.addEventListener('change', function() {
                // Небольшая задержка для лучшего UX
                setTimeout(() => {
                    form.submit();
                }, 100);
            });
        }
    });
});

// Быстрые фильтры
function quickFilter(status) {
    const statusSelect = document.getElementById('status');
    statusSelect.value = status;
    document.getElementById('filters-form').submit();
}

// Добавляем кнопки быстрых фильтров
document.addEventListener('DOMContentLoaded', function() {
    const statsContainer = document.querySelector('.admin-stats');
    if (statsContainer) {
        const quickFilters = document.createElement('div');
        quickFilters.className = 'quick-filters';
        quickFilters.innerHTML = `
            <div class="quick-filter-buttons">
                <button type="button" class="btn btn-sm btn-outline" onclick="quickFilter('new')">Только новые</button>
                <button type="button" class="btn btn-sm btn-outline" onclick="quickFilter('contacted')">Связались</button>
                <button type="button" class="btn btn-sm btn-outline" onclick="quickFilter('processed')">В работе</button>
                <button type="button" class="btn btn-sm btn-outline" onclick="quickFilter('completed')">Завершены</button>
                <button type="button" class="btn btn-sm btn-outline" onclick="quickFilter('')">Все</button>
            </div>
        `;
        statsContainer.appendChild(quickFilters);
    }
});
</script>

<style>
.quick-filters {
    margin-top: 15px;
}

.quick-filter-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.btn-outline {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #bbb;
    padding: 4px 8px;
    font-size: 0.75rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.3);
    color: #fff;
}

body.light .btn-outline {
    border-color: #dee2e6;
    color: #666;
}

body.light .btn-outline:hover {
    background: #f8f9fa;
    border-color: #adb5bd;
    color: #111;
}
</style>
@endsection
