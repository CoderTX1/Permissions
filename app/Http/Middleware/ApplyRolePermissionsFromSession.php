<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class ApplyRolePermissionsFromSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && session()->has('active_role')) {
            $roleName = session('active_role');

            $role = Role::where('name', $roleName)->first();
            if ($role) {
                // تحديث صلاحيات المستخدم مؤقتًا
                $permissions = $role->permissions->pluck('name')->toArray();

                // إلغاء صلاحيات سابقة وتعيين الجديدة مؤقتًا
                auth()->user()->syncPermissions($permissions);
            }
        }

        return $next($request);
    }
}
