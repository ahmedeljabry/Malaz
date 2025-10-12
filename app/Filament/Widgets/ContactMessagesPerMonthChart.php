<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Widgets\ChartWidget;

class ContactMessagesPerMonthChart extends ChartWidget
{
    protected ?string $heading = 'الرسائل شهرياً (آخر 12 شهر)';

    protected function getData(): array
    {
        $now = now();
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = (clone $now)->subMonths($i);
            $labels[] = $month->translatedFormat('M Y');
            $data[] = ContactMessage::query()
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'الرسائل',
                    'data' => $data,
                    'backgroundColor' => 'rgba(16,185,129,0.4)',
                    'borderColor' => '#10b981',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
