<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisionResource\Pages;
use App\Models\Vision;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class VisionResource extends Resource
{
    protected static ?string $model = Vision::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-eye';

    protected static \UnitEnum|string|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'الرؤية';

    protected static ?string $modelLabel = 'رؤية';

    protected static ?string $pluralModelLabel = 'الرؤى';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('الرؤية / Vision')->schema([
                Grid::make(2)->schema([
                    TextInput::make('head_title_ar')->label('العنوان الرئيسي (AR)')->placeholder('العنوان الرئيسي')->required()->maxLength(255),
                    TextInput::make('head_title_en')->label('العنوان الرئيسي (EN)')->placeholder('Head Title')->required()->maxLength(255),
                    TextInput::make('title_ar')->label('العنوان (AR)')->placeholder('عنوان فرعي')->maxLength(255),
                    TextInput::make('title_en')->label('العنوان (EN)')->placeholder('Subtitle')->maxLength(255),
                ]),
                FileUpload::make('image_path')
                    ->label('الصورة')
                    ->image()
                    ->disk('public')
                    ->directory('vision')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->moveFiles(),
                FileUpload::make('icon_path')
                    ->label('أيقونة')
                    ->image()
                    ->disk('public')
                    ->directory('vision/icons')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->moveFiles(),
                Tabs::make('Body')->tabs([
                    Tab::make('العربية')->schema([
                        RichEditor::make('body_ar')
                            ->label('المحتوى (AR)')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'orderedList', 'blockquote', 'h2', 'h3', 'undo', 'redo'])
                            ->columnSpanFull(),
                    ]),
                    Tab::make('English')->schema([
                        RichEditor::make('body_en')
                            ->label('المحتوى (EN)')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'orderedList', 'blockquote', 'h2', 'h3', 'undo', 'redo'])
                            ->columnSpanFull(),
                    ]),
                ])->columnSpanFull(),
                TextInput::make('sort_order')->label('الترتيب')->numeric()->default(1),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')->label('الصورة')->disk('public')->square(),
                ImageColumn::make('icon_path')->label('الأيقونة')->disk('public')->square(),
                TextColumn::make('head_title_ar')->label('العنوان الرئيسي (AR)')->searchable(),
                TextColumn::make('head_title_en')->label('Head Title (EN)')->searchable(),
                TextColumn::make('sort_order')->label('الترتيب')->numeric()->sortable(),
                TextColumn::make('updated_at')->label('آخر تعديل')->since()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\TernaryFilter::make('has_image')
                    ->label('صورة')
                    ->trueLabel('مع صورة')
                    ->falseLabel('بدون صورة')
                    ->queries(
                        true: fn ($q) => $q->whereNotNull('image_path')->where('image_path', '!=', ''),
                        false: fn ($q) => $q->where(fn ($qq) => $qq->whereNull('image_path')->orWhere('image_path', '')),
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
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('sort_order'))
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
            'index' => Pages\ListVisions::route('/'),
            'create' => Pages\CreateVision::route('/create'),
            'edit' => Pages\EditVision::route('/{record}/edit'),
        ];
    }
}
