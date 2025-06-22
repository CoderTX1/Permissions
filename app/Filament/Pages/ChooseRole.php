<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions\Action;

class ChooseRole extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static string $view = 'filament.pages.choose-role';
    protected static ?string $navigationLabel = 'اختيار الدور';
    protected static ?string $title = 'اختيار الدور';
   protected static bool $shouldRegisterNavigation = false;
    public ?string $role = null;

    public function mount(): void
    {
        $this->form->fill();
     //   dd(auth()->user()->roles->toArray());
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('role')
                ->label('اختر الدور الذي تريد الدخول به')
                ->options(auth()->user()->roles->pluck('name', 'name')->toArray())
                ->required()
                ->native(false),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('دخول بهذا الدور')
                ->color('primary')
                ->action(fn () => $this->save()),
        ];
    }

    public function save(): void
    {
        if (!$this->role) {
            $this->notify('danger', 'يجب اختيار دور');
            return;
        }

        session(['active_role' => $this->role]);
        $this->redirect('/admin');
    }
}