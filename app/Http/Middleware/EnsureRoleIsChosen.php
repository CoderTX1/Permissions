<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRoleIsChosen
{
public function handle(Request $request, Closure $next): Response
{
    if (auth()->check()) {
        if (!session()->has('active_role')) {
            if (! $request->is('admin/choose-role') && ! $request->is('admin/logout')) {
                return redirect('/admin/choose-role');
            }
        }
    }

    return $next($request);
}

}
