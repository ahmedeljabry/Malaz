<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'slug',
        'name_en',
        'name_ar',
        'is_active',
        'sort_order',
        'show_on_home',
        'main_image',
        'icon_path',
    ];

    protected $casts = [
        'is_active'    => 'bool',
        'show_on_home' => 'bool',
        'sort_order'   => 'int',
    ];

    public function scopeActive() { return $this->where('is_active', true); }
    public function scopeHome() { return $this->where('show_on_home', true);}
    public function sections() { return $this->hasMany(ServiceSection::class , 'service_id')->orderBy('id'); }
    public function getNameAttribute(): string { return $this->attributes['name_'.(app()->getLocale() === 'ar' ? 'ar' : 'en')] ?? ''; }

    public function getIconUrlAttribute(): ?string
    {
        if (! $this->icon_path) {
            return null;
        }

        return asset('storage/' . ltrim($this->icon_path, '/'));
    }

}
