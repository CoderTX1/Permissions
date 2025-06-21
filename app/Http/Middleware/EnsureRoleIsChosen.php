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
            // وإذا ما فيه دور محفوظ
            if (! session()->has('active_role')) {
                // نتأكد أننا مش في صفحة اختيار الدور نفسها (عشان ما نعمل redirect دائم)
                if (! $request->is('admin/choose-role')) {
                    return redirect('/admin/choose-role');
                }
            }
        }

        return $next($request);
    }
}
