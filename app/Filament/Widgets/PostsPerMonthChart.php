<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PostsPerMonthChart extends ChartWidget
{
    protected ?string $heading = 'المقالات شهرياً (آخر 12 شهر)';

    protected function getData(): array
    {
        $now = now();
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = (clone $now)->subMonths($i);
            $labels[] = $month->translatedFormat('M Y');
            $data[] = Post::query()
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'المقالات',
                    'data' => $data,
                    'borderColor' => '#60a5fa',
                    'backgroundColor' => 'rgba(96,165,250,0.2)',
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
