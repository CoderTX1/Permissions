<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyChosenRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && session()->has('active_role')) {
            $user = Auth::user();

            $user->roles->filter(function ($role) {
                return $role->name !== session('active_role');
            })->each(function ($role) use ($user) {
                $user->removeRole($role->name);
            });
            if (! $user->hasRole(session('active_role'))) {
                $user->assignRole(session('active_role'));
            }
        }

        return $next($request);
    }
}
