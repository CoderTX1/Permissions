<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // $this->registerPolicies();

        // // ✅ السماح بناءً على صلاحيات الدور النشط فقط
        // Gate::before(function ($user, $ability) {
        //     $roleName = session('active_role');

        //     if (!$roleName) return null;

        //     $role = Role::where('name', $roleName)->first();

        //     if ($role && $role->hasPermissionTo($ability)) {
        //         return true;
        //     }

        //     return false;
        // });
    }
}
