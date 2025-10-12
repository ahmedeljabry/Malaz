<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $fillable = [
        'name','logo_path', 'sort_order', 'is_active',
    ];
    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive()
    {
        return $this->where('is_active', true);
    }

    public function getImageAttribute(): ?string
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }
        return null;
    }

}

