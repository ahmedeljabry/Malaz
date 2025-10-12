<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'key', 'value_en', 'value_ar'
    ];

    public static function value(string $key): ?string
    {
        $setting = self::query()->where('key', $key)->first();
        if (! $setting) {
            return null;
        }

        $column = 'value_' . (app()->getLocale() === 'ar' ? 'ar' : 'en');
        $value = $setting->getAttribute($column);

        if ($value === null || $value === '') {
            $value = $setting->getAttribute('value_en');
        }

        return $value;
    }
}
