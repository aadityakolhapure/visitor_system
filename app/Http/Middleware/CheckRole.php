<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            Auth::logout();
            return redirect()
                ->route($role === 'admin' ? 'admin.login' : 'login')
                ->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
