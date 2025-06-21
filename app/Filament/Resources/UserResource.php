<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('email_verified_at'),

            Forms\Components\TextInput::make('password')
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                ->required(fn (string $context) => $context === 'create')
                ->label('Password'),
        ]);
    }

  public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->label('الاسم')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني')->searchable(),

            Tables\Columns\TextColumn::make('roles.name')
                ->label('الأدوار')
                ->badge()
                ->colors(['primary'])
                ->separator(', ')
                ->sortable(),

            Tables\Columns\TextColumn::make('permissions.name')
                ->label('الصلاحيات')
                ->badge()
                ->colors(['success'])
                ->separator(', ')
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}


    public static function getRelations(): array
    {
        return [];
    }

    /**
     * التحقق من أن المستخدم لديه صلاحية بناءً على الدور النشط
     */
// protected static function hasPermission(string $permission): bool
// {
//     $user = auth()->user();
//     $role = session('active_role');

//     return $user && $role && $user->hasRole($role) && $user->hasPermissionTo($permission);
// }


//     public static function canViewAny(): bool
//     {
//         return static::hasPermission('view_user');
//     }

//     public static function canCreate(): bool
//     {
//         return static::hasPermission('create_user');
//     }

//     public static function canEdit(Model $record): bool
//     {
//         return static::hasPermission('edit_user');
//     }

//     public static function canDelete(Model $record): bool
//     {
//         return static::hasPermission('delete_user');
//     }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
