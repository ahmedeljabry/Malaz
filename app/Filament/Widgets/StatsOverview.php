<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Partner;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $posts = Post::query()->count();
        $partners = Partner::query()->count();
        $newMessages = ContactMessage::query()->where('status', 'new')->count();
        $resolvedMessages = ContactMessage::query()->where('status', 'resolved')->count();

        return [
            Stat::make('المقالات', number_format($posts))
                ->icon('heroicon-o-newspaper'),

            Stat::make('الشركاء', number_format($partners))
                ->icon('heroicon-o-users'),

            Stat::make('الرسائل الجديدة', number_format($newMessages))
                ->icon('heroicon-o-inbox')
                ->color('warning'),

            Stat::make('الرسائل المحلولة', number_format($resolvedMessages))
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}


