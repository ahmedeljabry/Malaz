<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'main_image',
        'slug',
        'title_en', 'title_ar',
        'body_en', 'body_ar',
        'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getTitleAttribute(): string
    {
        $locale = app()->getLocale();
        return $this->attributes['title_'.($locale === 'ar' ? 'ar' : 'en')] ?? '';
    }

    public function getBodyAttribute(): string
    {
        $locale = app()->getLocale();
        return $this->attributes['body_'.($locale === 'ar' ? 'ar' : 'en')] ?? '';
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->main_image) {
            return asset('web/img/Rectangle 7.png');
        }
        return asset('storage/' . $this->main_image);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->latest('published_at');
    }
}

