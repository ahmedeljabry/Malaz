<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;

use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;

use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-group';
    protected static \UnitEnum|string|null $navigationGroup = 'المحتوى';
    protected static ?string $navigationLabel = 'الخدمات';
    protected static ?string $modelLabel = 'خدمة';
    protected static ?string $pluralModelLabel = 'خدمات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('البيانات الأساسية')->schema([
                Grid::make(2)->schema([
                    TextInput::make('name_ar')->label('الاسم (ع)')->required()->maxLength(255),
                    TextInput::make('name_en')->label('الاسم (EN)')->required()->maxLength(255),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->maxLength(255),

                    TextInput::make('sort_order')
                        ->label('الترتيب')
                        ->numeric()
                        ->default(1),

                    FileUpload::make('main_image')
                        ->label('الصورة الرئيسية')
                        ->image()
                        ->directory('services/main')
                        ->openable()
                        ->downloadable()
                        ->columnSpanFull(),

                    Toggle::make('is_active')->label('مفعل')->default(true),
                    Toggle::make('show_on_home')->label('بالرئيسية')->default(true),
                ]),
            ])->columnSpanFull(),

            Section::make('محتوى الخدمة')->schema([
                Repeater::make('sections')
                    ->label('المحتوي')
                    ->relationship('sections')
                    ->defaultItems(1)
                    ->minItems(1)
                    ->collapsible()
                    ->schema([
                        Fieldset::make('عربي')->schema([
                            RichEditor::make('body_ar')
                                ->label('النص (ع)')
                                ->columnSpanFull()
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strike',
                                    'link',
                                    'orderedList',
                                    'blockquote',
                                    'h2',
                                    'h3',
                                    'codeBlock',
                                    'undo',
                                    'redo',
                                ])
                                ->extraInputAttributes(['style' => 'min-height: 11rem; overflow-y: auto;']),
                                FileUpload::make('image_ar')
                                    ->label('الصورة (ع)')
                                    ->image()
                                    ->directory('services/sections')
                                    ->openable()
                                    ->downloadable()
                                    ->columnSpanFull(),

                        ]),
                        Fieldset::make('English')->schema([
                            RichEditor::make('body_en')
                                ->label('النص (EN)')
                                ->columnSpanFull()
                                ->columns(7)
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strike',
                                    'link',
                                    'orderedList',
                                    'blockquote',
                                    'h2',
                                    'h3',
                                    'codeBlock',
                                    'undo',
                                    'redo',
                                ])
                                ->extraInputAttributes(['style' => 'min-height: 11rem; overflow-y: auto;']),
                                FileUpload::make('image_en')
                                    ->label('الصورة (EN)')
                                    ->image()
                                    ->directory('services/sections')
                                    ->openable()
                                    ->downloadable()
                                    ->columnSpanFull(),
                        ]),
                    ])
                    ->columnSpanFull(),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name_ar')->label('الاسم (ع)')->searchable()->sortable(),
                TextColumn::make('name_ar')->label('الاسم (EN)')->searchable()->sortable(),
                TextColumn::make('sort_order')->label('ترتيب')->sortable(),
                IconColumn::make('is_active')->label('مفعل')->boolean(),
                IconColumn::make('show_on_home')->label('بالرئيسية')->boolean(),
                TextColumn::make('updated_at')->label('آخر تحديث')->since()->sortable(),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                CreateAction::make()->label('إضافة خدمة'),
            ])
            ->actions([
                EditAction::make()->label('تعديل'),
                DeleteAction::make()->label('حذف'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('حذف جماعي'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
