<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin()) {
            return response()->json(['Forbidden', Response::HTTP_FORBIDDEN]);
        }

        return $next($request);
    }
}
