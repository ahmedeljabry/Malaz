<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Resources\Resource;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static \UnitEnum|string|null $navigationGroup = 'الإعدادات';

    protected static ?string $navigationLabel = 'إعدادات الموقع';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSiteSettings::route('/'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return static::getUrl('index');
    }
}
