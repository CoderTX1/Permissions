<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class LoadPermissionsFromActiveRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && session()->has('active_role')) {
            $user = Auth::user();
            $activeRole = session('active_role');

            if ($user->hasRole($activeRole)) {
                $role = Role::where('name', $activeRole)->first();

                if ($role) {
                    // ننسى الصلاحيات المخزنة مؤقتاً
                    $user->forgetCachedPermissions();

                    // نزيل كل الصلاحيات المباشرة للمستخدم (مؤقتاً)
                    $user->permissions()->detach();

                    // ونعيد تحميل فقط صلاحيات الدور النشط
                    foreach ($role->permissions as $permission) {
                        $user->givePermissionTo($permission->name);
                    }
                }
            }
        }

        return $next($request);
    }
}
