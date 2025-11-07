<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoneThickness extends Model
{
    use HasFactory;

    protected $fillable = [
        'stone_id',
        'thickness_mm',
    ];

    public function stone(): BelongsTo
    {
        return $this->belongsTo(Stone::class);
    }
}













