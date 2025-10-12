<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentContactMessages extends BaseWidget
{
    protected static ?string $heading = 'أحدث الرسائل';

    protected int|string|array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                ContactMessage::query()->latest()
            )
            ->columns([
                TextColumn::make('name')->label('الاسم')->searchable(),
                TextColumn::make('email')->label('البريد')->searchable(),
                TextColumn::make('subject')->label('العنوان')->limit(40),
                TextColumn::make('status')->label('الحالة')->badge()->color(fn (string $state) => match ($state) {
                    'new' => 'warning',
                    'in_progress' => 'info',
                    'resolved' => 'success',
                    default => 'gray',
                }),
                TextColumn::make('created_at')->label('منذ')->since(),
            ])
            ->paginated([5])
            ->defaultSort('created_at', 'desc');
    }
}
