<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-users';

    protected static \UnitEnum|string|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'الشركاء';

    protected static ?string $modelLabel = 'شريك';

    protected static ?string $pluralModelLabel = 'الشركاء';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('بيانات الشريك')->schema([
                Grid::make(2)->schema([
                    TextInput::make('name_ar')->label('الاسم (AR)')->required()->maxLength(255),
                    TextInput::make('name_en')->label('الاسم (EN)')->required()->maxLength(255),
                ]),
                FileUpload::make('logo_path')
                    ->label('الشعار')
                    ->image()
                    ->disk('public')
                    ->directory('partners/logo')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->moveFiles(),
                TextInput::make('sort_order')->label('الترتيب')->numeric()->default(1),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')->label('الشعار')->disk('public')->square(),
                TextColumn::make('name_ar')->label('الاسم (AR)')->searchable()->sortable(),
                TextColumn::make('name_en')->label('Name (EN)')->searchable()->sortable(),
                TextColumn::make('sort_order')->label('الترتيب')->numeric()->sortable(),
                TextColumn::make('updated_at')->label('آخر تعديل')->since()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\TernaryFilter::make('has_logo')
                    ->label('شعار')
                    ->trueLabel('مع شعار')
                    ->falseLabel('بدون شعار')
                    ->queries(
                        true: fn ($q) => $q->whereNotNull('logo_path')->where('logo_path', '!=', ''),
                        false: fn ($q) => $q->where(fn ($qq) => $qq->whereNull('logo_path')->orWhere('logo_path', '')),
                    ),
                \Filament\Tables\Filters\Filter::make('sort_order')
                    ->label('الترتيب')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('min')->label('من')->numeric(),
                        \Filament\Forms\Components\TextInput::make('max')->label('إلى')->numeric(),
                    ])
                    ->query(fn ($query, array $data) => $query
                        ->when($data['min'] ?? null, fn ($q, $v) => $q->where('sort_order', '>=', (int) $v))
                        ->when($data['max'] ?? null, fn ($q, $v) => $q->where('sort_order', '<=', (int) $v))
                    ),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->orderBy('sort_order')->orderByDesc('id'))
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}


