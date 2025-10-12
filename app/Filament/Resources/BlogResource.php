<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Post as Blog;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step as WizardStep;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-newspaper';

    protected static \UnitEnum|string|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'المدوّنة';

    protected static ?string $modelLabel = 'مقال';

    protected static ?string $pluralModelLabel = 'المقالات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Wizard::make([
                WizardStep::make('المعرّف والمظهر')->schema([
                    Section::make()->schema([
                        Grid::make(2)->schema([
                            TextInput::make('slug')
                                ->label('المعرّف')
                                ->placeholder('unique-slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            FileUpload::make('main_image')
                                ->label('الصورة الرئيسية')
                                ->image()
                                ->disk('public')
                                ->directory('blogs/cover')
                                ->visibility('public')
                                ->preserveFilenames()
                                ->moveFiles()
                                ->columnSpanFull(),
                        ]),
                    ]),
                ]),

                WizardStep::make('العناوين')->schema([
                    Tabs::make('titles')->tabs([
                        Tab::make('العربية')->schema([
                            TextInput::make('title_ar')->label('العنوان (AR)')->placeholder('عنوان المقال')->required()->maxLength(255),
                        ]),
                        Tab::make('English')->schema([
                            TextInput::make('title_en')->label('العنوان (EN)')->placeholder('Post title')->required()->maxLength(255),
                        ]),
                    ]),
                ]),

                WizardStep::make('المحتوى والنشر')->schema([
                    Tabs::make('contentTabs')->tabs([
                        Tab::make('العربية')->schema([
                            RichEditor::make('body_ar')
                                ->label('المحتوى (AR)')
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
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('blogs/body')
                                ->fileAttachmentsVisibility('public')
                                ->extraInputAttributes(['style' => 'min-height:18rem;max-height:32rem;overflow-y:auto;'])
                                ->columnSpanFull(),
                        ]),
                        Tab::make('English')->schema([
                            RichEditor::make('body_en')
                                ->label('المحتوى (EN)')
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
                                ->fileAttachmentsDisk('public')
                                ->fileAttachmentsDirectory('blogs/body')
                                ->fileAttachmentsVisibility('public')
                                ->extraInputAttributes(['style' => 'min-height:18rem;max-height:32rem;overflow-y:auto;'])
                                ->columnSpanFull(),
                        ]),
                    ])->columnSpanFull(),

                    Section::make('النشر')->schema([
                        Toggle::make('is_published')->label('منشور'),
                        DateTimePicker::make('published_at')
                            ->label('تاريخ النشر')
                            ->seconds(false)
                            ->native(false)
                            ->nullable(),
                    ]),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('main_image')->label('الصورة')->disk('public')->square(),
                TextColumn::make('slug')->label('المعرّف')->searchable()->sortable(),
                TextColumn::make('title')->label('العنوان')->searchable()->sortable(),
                IconColumn::make('is_published')->label('منشور')->boolean(),
                TextColumn::make('published_at')->label('تاريخ النشر')->dateTime()->sortable(),
                TextColumn::make('updated_at')->label('آخر تعديل')->since()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')->label('منشور')
                    ->boolean(),
                Filter::make('published_at')
                    ->label('تاريخ النشر')
                    ->form([
                        DatePicker::make('from')->label('من'),
                        DatePicker::make('until')->label('إلى'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'] ?? null, fn($q, $date) => $q->whereDate('published_at', '>=', $date))
                            ->when($data['until'] ?? null, fn($q, $date) => $q->whereDate('published_at', '<=', $date));
                    }),
            ])
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
