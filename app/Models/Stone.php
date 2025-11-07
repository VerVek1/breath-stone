<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'material_id',
        'manufacturer_id',
        'color',
        'texture',
        'description',
        'photo_path',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function thicknesses(): HasMany
    {
        return $this->hasMany(StoneThickness::class);
    }

    /**
     * Автоматическое создание slug при сохранении
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($stone) {
            if (empty($stone->slug)) {
                $stone->slug = \Illuminate\Support\Str::slug($stone->name);
            }
        });
        
        static::updating(function ($stone) {
            if ($stone->isDirty('name') && empty($stone->slug)) {
                $stone->slug = \Illuminate\Support\Str::slug($stone->name);
            }
        });
    }

    /**
     * Route model binding по slug
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}


