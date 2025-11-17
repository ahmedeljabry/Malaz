<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $fillable = [
        'title_en', 'title_ar',
        'head_title_ar' , 'head_title_en',
        'body_en', 'body_ar',
        'image_path', 'icon_path', 'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function getIconUrlAttribute(): ?string
    {
        if (! $this->icon_path) {
            return null;
        }

        return asset('storage/' . ltrim($this->icon_path, '/'));
    }
}
