<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select as FormSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-inbox';

    protected static \UnitEnum|string|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'الرسائل';

    protected static ?string $modelLabel = 'رسالة';

    protected static ?string $pluralModelLabel = 'الرسائل';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('تفاصيل الرسالة')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')->label('الاسم')->placeholder('الاسم الكامل')->disabled(),
                        TextInput::make('email')->label('البريد الإلكتروني')->placeholder('name@example.com')->disabled(),
                        TextInput::make('phone')->label('الهاتف')->placeholder('+9665xxxxxxx')->disabled()->columnSpanFull(),
                        TextInput::make('subject')->label('العنوان')->placeholder('موضوع الرسالة')->disabled()->columnSpanFull(),
                        Textarea::make('message')->label('نص الرسالة')->placeholder('اكتب رسالتك هنا')->disabled()->rows(6)->columnSpanFull(),
                    ]),
                ]),

            Section::make('الحالة')
                ->schema([
                    FormSelect::make('status')
                        ->label('الحالة')
                        ->options([
                            'new' => 'جديد',
                            'in_progress' => 'قيد المعالجة',
                            'resolved' => 'تم الحل',
                        ])->required(),
                ]),

            Section::make('كشف الرسائل المزعجة')
                ->schema([
                    \Filament\Schemas\Components\Toggle::make('is_spam')
                        ->label('رسالة مزعجة')
                        ->helperText('حدد إذا كانت هذه الرسالة مزعجة'),

                    \Filament\Schemas\Components\TextInput::make('spam_score')
                        ->label('درجة الإزعاج')
                        ->numeric()
                        ->min(0)
                        ->max(1)
                        ->step(0.01)
                        ->disabled()
                        ->helperText('الدرجة المحسوبة تلقائياً'),

                    \Filament\Schemas\Components\Textarea::make('spam_reasons_display')
                        ->label('أسباب الإزعاج')
                        ->disabled()
                        ->rows(3)
                        ->formatStateUsing(fn ($record) => $record ? implode("\n", $record->spam_reasons ?? []) : '')
                        ->helperText('الأسباب التي أدت لتصنيف الرسالة كمزعجة'),

                    \Filament\Schemas\Components\TextInput::make('ip_address')
                        ->label('عنوان IP')
                        ->disabled(),

                    \Filament\Schemas\Components\Textarea::make('user_agent')
                        ->label('متصفح المستخدم')
                        ->disabled()
                        ->rows(2),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('الاسم')->searchable()->sortable(),
                TextColumn::make('email')->label('البريد')->searchable(),
                TextColumn::make('phone')->label('الهاتف')->toggleable(),
                TextColumn::make('subject')->label('العنوان')->toggleable(),
                TextColumn::make('status')->label('الحالة')->badge()->color(fn (string $state): string => match ($state) {
                    'new' => 'warning',
                    'in_progress' => 'info',
                    'resolved' => 'success',
                    default => 'gray',
                }),
                \Filament\Tables\Columns\IconColumn::make('is_spam')
                    ->label('مزعجة')
                    ->boolean()
                    ->trueIcon('heroicon-o-exclamation-triangle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success'),
                TextColumn::make('spam_score')
                    ->label('درجة الإزعاج')
                    ->numeric(2)
                    ->color(fn ($record) => $record->spam_score > 0.6 ? 'danger' : 'success')
                    ->toggleable(),
                TextColumn::make('created_at')->label('أُنشئت')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'new' => 'جديد',
                        'in_progress' => 'قيد المعالجة',
                        'resolved' => 'تم الحل',
                    ]),
                SelectFilter::make('is_spam')
                    ->label('نوع الرسالة')
                    ->options([
                        '0' => 'عادية',
                        '1' => 'مزعجة',
                    ]),
                \Filament\Tables\Filters\Filter::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->form([
                        DatePicker::make('from')->label('من'),
                        DatePicker::make('until')->label('إلى'),
                    ])
                    ->query(fn ($query, array $data) => $query
                        ->when($data['from'] ?? null, fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                        ->when($data['until'] ?? null, fn ($q, $date) => $q->whereDate('created_at', '<=', $date))
                    ),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make()->slideOver(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('mark_as_spam')
                        ->label('تحديد كمزعجة')
                        ->icon('heroicon-o-exclamation-triangle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['is_spam' => true])),
                    BulkAction::make('mark_as_not_spam')
                        ->label('تحديد كعادية')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['is_spam' => false])),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}
