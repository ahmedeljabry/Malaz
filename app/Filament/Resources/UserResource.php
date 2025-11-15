<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\DateTimePicker;
use Filament\Schemas\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static string|\UnitEnum|null $navigationGroup = 'إدارة المستخدمين';

    protected static ?string $navigationLabel = 'المستخدمون';

    protected static ?string $modelLabel = 'مستخدم';

    protected static ?string $pluralModelLabel = 'المستخدمون';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('معلومات المستخدم')
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('password')
                            ->label('كلمة المرور')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8),

                        Select::make('roles')
                            ->label('الأدوار')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),
                    ])->columns(2),

                Section::make('معلومات إضافية')
                    ->schema([
                        DateTimePicker::make('email_verified_at')
                            ->label('تاريخ التحقق من البريد'),

                        Placeholder::make('created_at')
                            ->label('تاريخ الإنشاء')
                            ->content(fn ($record) => $record?->created_at?->diffForHumans()),

                        Placeholder::make('updated_at')
                            ->label('تاريخ التحديث')
                            ->content(fn ($record) => $record?->updated_at?->diffForHumans()),
                    ])->columns(3)->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('roles.name')
                    ->label('الأدوار')
                    ->badge()
                    ->color('primary')
                    ->listWithLineBreaks(),

                IconColumn::make('email_verified_at')
                    ->label('محقق')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('تاريخ التحديث')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->label('الأدوار')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Tables\Actions\DeleteAction $action, User $record) {
                        // Prevent self-deletion
                        if ($record->id === auth()->id()) {
                            $action->cancel();
                            throw new \Exception('لا يمكنك حذف حسابك الخاص!');
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Tables\Actions\DeleteBulkAction $action, $records) {
                            // Prevent self-deletion in bulk actions
                            foreach ($records as $record) {
                                if ($record->id === auth()->id()) {
                                    $action->cancel();
                                    throw new \Exception('لا يمكنك حذف حسابك الخاص!');
                                }
                            }
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('roles');
    }
}
