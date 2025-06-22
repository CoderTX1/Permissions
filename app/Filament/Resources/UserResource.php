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
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
            ->dehydrateStateUsing(fn ($state) => filled($state) ? \Hash::make($state) : null)
            ->required(fn (string $context) => $context === 'create')
            ->label('كلمة المرور'),

        Forms\Components\Select::make('roles')
            ->label('الأدوار')
            ->multiple()
            ->relationship('roles', 'name')
            ->preload()
            ->searchable(),

        Forms\Components\Select::make('permissions')
            ->label('الصلاحيات')
            ->multiple()
            ->relationship('permissions', 'name')
            ->preload()
            ->searchable(),
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

// public static function canAccess(): bool
// {
//     return auth()->check()
//         && (
//             auth()->user()->hasAnyRole(['super_admin', 'admin']) ||
//             auth()->user()->hasAnyPermission(['view_any_user', 'browse_users'])
//         );
// }



// public static function canAccess(): bool
// {
//     if (! auth()->check()) {
//         return false;
//     }
//     $allPermissions = Permission::pluck('name')->toArray();

//     // التأكد أن المستخدم لديه أي صلاحية من هذه
//     return auth()->user()->hasAnyRole(['super_admin', 'admin'])
//         || auth()->user()->hasAnyPermission($allPermissions);
// }



public static function canAccess(): bool
{
    if (! auth()->check()) {
        return false;
    }

    // جميع الأدوار من قاعدة البيانات
    $allRoles = Role::pluck('name')->toArray();

    // جميع الصلاحيات من قاعدة البيانات
    $allPermissions = Permission::pluck('name')->toArray();

    return auth()->user()->hasAnyRole($allRoles)
        || auth()->user()->hasAnyPermission($allPermissions);
}


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
