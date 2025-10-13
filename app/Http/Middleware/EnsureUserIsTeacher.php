<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class EnsureUserIsTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isTeacher()) {
            abort(403, 'この機能は先生のみ利用できます');
        }

        return $next($request);
    }
}
