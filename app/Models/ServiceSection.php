<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    protected $table = 'service_sections';
    protected $fillable = [
        'service_id',
        'body_en',
        'body_ar',
        'image_en',
        'image_ar'
    ];

    public function service() { return $this->belongsTo(Service::class , 'service_id');}
    public function getBodyAttribute(): ?string { return $this->attributes['body_'.(app()->getLocale() === 'ar' ? 'ar' : 'en')]; }
    public function getImageAttribute(): ?string { return 'storage/' . $this->attributes['image_'.(app()->getLocale() === 'ar' ? 'ar' : 'en')]; }

}
