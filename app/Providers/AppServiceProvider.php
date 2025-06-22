<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
  use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


public function boot()
{
    Gate::before(function ($user, $ability) {
        $activeRole = session('active_role');

        if ($activeRole && $user->hasRole($activeRole)) {
            $role = Role::where('name', $activeRole)->with('permissions')->first();

            if ($role) {
                return $role->permissions->pluck('name')->contains($ability);
            }
        }

        return null;
    });
}

}
