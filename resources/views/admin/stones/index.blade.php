@extends('layouts.app')
@section('title', 'Камни | Админ-панель')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Камни</h1>
        <div class="admin-stats">
            <div class="stat-card">
                <span class="stat-number">{{ $stats['total'] }}</span>
                <span class="stat-label">Всего камней</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $stats['with_material'] }}</span>
                <span class="stat-label">С материалом</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $stats['with_manufacturer'] }}</span>
                <span class="stat-label">С производителем</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $stats['with_photo'] }}</span>
                <span class="stat-label">С фото</span>
            </div>
        </div>
    </div>

    @if(session('status'))
        <div class="alert alert-success" style="margin: 20px 0; padding: 12px; background: rgba(76, 175, 80, 0.1); border: 1px solid rgba(76, 175, 80, 0.3); border-radius: 6px; color: #4caf50;">{{ session('status') }}</div>
    @endif

    <!-- Фильтры -->
    <div class="filters-container">
        <form method="GET" action="{{ route('admin.stones.index') }}" class="filters-form" id="filters-form">
            <div class="filters-row">
                <div class="filter-group">
                    <label for="search">Поиск</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Название, артикул, описание...">
                </div>
                
                <div class="filter-group">
                    <label for="material_id">Материал</label>
                    <select id="material_id" name="material_id">
                        <option value="">Все материалы</option>
                        @foreach($materials as $id => $name)
                            <option value="{{ $id }}" {{ request('material_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="manufacturer_id">Производитель</label>
                    <select id="manufacturer_id" name="manufacturer_id">
                        <option value="">Все производители</option>
                        @foreach($manufacturers as $id => $name)
                            <option value="{{ $id }}" {{ request('manufacturer_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="color">Цвет</label>
                    <input type="text" id="color" name="color" value="{{ request('color') }}" placeholder="Цвет камня...">
                </div>
                
                <div class="filter-group">
                    <label for="texture">Текстура</label>
                    <input type="text" id="texture" name="texture" value="{{ request('texture') }}" placeholder="Текстура камня...">
                </div>
                
                <div class="filter-group">
                    <label for="sort_by">Сортировка</label>
                    <select id="sort_by" name="sort_by">
                        <option value="id" {{ request('sort_by') === 'id' ? 'selected' : '' }}>По ID</option>
                        <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>По названию</option>
                        <option value="sku" {{ request('sort_by') === 'sku' ? 'selected' : '' }}>По артикулу</option>
                        <option value="color" {{ request('sort_by') === 'color' ? 'selected' : '' }}>По цвету</option>
                        <option value="texture" {{ request('sort_by') === 'texture' ? 'selected' : '' }}>По текстуре</option>
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>По дате</option>
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
                <a href="{{ route('admin.stones.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-times"></i> Сбросить
                </a>
                <a href="{{ route('admin.stones.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Добавить камень
                </a>
            </div>
        </form>
    </div>
    <div class="applications-table-container">
        <table class="applications-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Артикул</th>
                    <th>Материал</th>
                    <th>Производитель</th>
                    <th>Толщины</th>
                    <th>Цвет</th>
                    <th>Текстура</th>
                    <th>Описание</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stones as $stone)
                    <tr class="application-row">
                        <td>{{ $stone->id }}</td>
                        <td>
                            <strong>{{ $stone->name }}</strong>
                            @if($stone->photo_path)
                                <i class="fa-solid fa-image" style="margin-left: 5px; color: #4a9eff;" title="Есть фото"></i>
                            @endif
                        </td>
                        <td><code>{{ $stone->sku }}</code></td>
                        <td>
                            @if($stone->material)
                                <span class="badge">{{ $stone->material->name }}</span>
                            @else
                                <span class="no-data">—</span>
                            @endif
                        </td>
                        <td>
                            @if($stone->manufacturer)
                                {{ $stone->manufacturer->name }}
                            @else
                                <span class="no-data">—</span>
                            @endif
                        </td>
                        <td>
                            @if($stone->thicknesses->count() > 0)
                                <span class="thicknesses">
                                    {{ $stone->thicknesses->pluck('thickness_mm')->map(fn($v) => rtrim(rtrim(number_format($v, 2, ',', ' '), '0'), ',').' мм')->implode(', ') }}
                                </span>
                            @else
                                <span class="no-data">—</span>
                            @endif
                        </td>
                        <td>
                            @if($stone->color)
                                <span class="color-badge">{{ $stone->color }}</span>
                            @else
                                <span class="no-data">—</span>
                            @endif
                        </td>
                        <td>
                            @if($stone->texture)
                                {{ $stone->texture }}
                            @else
                                <span class="no-data">—</span>
                            @endif
                        </td>
                        <td>
                            @if($stone->description)
                                <span class="description-text">{{ \Illuminate\Support\Str::limit($stone->description, 60) }}</span>
                            @else
                                <span class="no-data">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.stones.edit', $stone) }}" class="btn btn-sm btn-view" title="Редактировать">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-delete" onclick="deleteStone({{ $stone->id }})" title="Удалить">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="no-data">Камни не найдены</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($stones->hasPages())
    <div class="pagination-container">
        {{ $stones->links() }}
    </div>
    @endif
</div>

<script>
// Удаление камня
function deleteStone(stoneId) {
    if (!confirm('Вы уверены, что хотите удалить этот камень?')) {
        return;
    }
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/stones/${stoneId}`;
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const methodField = document.createElement('input');
    methodField.type = 'hidden';
    methodField.name = '_method';
    methodField.value = 'DELETE';
    
    form.appendChild(csrfToken);
    form.appendChild(methodField);
    document.body.appendChild(form);
    form.submit();
}

// Автосохранение фильтров в localStorage
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filters-form');
    const inputs = form.querySelectorAll('input, select');
    
    // Загружаем сохраненные фильтры
    const savedFilters = localStorage.getItem('stones_filters');
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
            localStorage.setItem('stones_filters', JSON.stringify(filters));
        });
    });
    
    // Автоотправка формы при изменении некоторых полей
    const autoSubmitFields = ['material_id', 'manufacturer_id', 'sort_by', 'sort_order'];
    autoSubmitFields.forEach(fieldName => {
        const field = form.querySelector(`[name="${fieldName}"]`);
        if (field) {
            field.addEventListener('change', function() {
                setTimeout(() => {
                    form.submit();
                }, 100);
            });
        }
    });
});

// Быстрые фильтры
function quickFilter(materialId, manufacturerId) {
    const materialSelect = document.getElementById('material_id');
    const manufacturerSelect = document.getElementById('manufacturer_id');
    
    if (materialId) materialSelect.value = materialId;
    if (manufacturerId) manufacturerSelect.value = manufacturerId;
    
    document.getElementById('filters-form').submit();
}
</script>

<style>
.badge {
    background: rgba(74, 158, 255, 0.2);
    color: #4a9eff;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.color-badge {
    background: rgba(255, 193, 7, 0.2);
    color: #ffc107;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.thicknesses {
    font-family: monospace;
    font-size: 0.875rem;
    color: #4a9eff;
}

.description-text {
    color: #bbb;
    font-size: 0.875rem;
    line-height: 1.4;
}

.btn-success {
    background: #28a745;
    color: #fff;
}

.btn-success:hover {
    background: #218838;
}

/* Light theme */
body.light .badge {
    background: rgba(74, 158, 255, 0.1);
    color: #4a9eff;
}

body.light .color-badge {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

body.light .thicknesses {
    color: #4a9eff;
}

body.light .description-text {
    color: #666;
}
</style>
@endsection


