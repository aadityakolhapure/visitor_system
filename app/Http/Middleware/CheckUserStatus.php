<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status !== 'approved') {
            Auth::logout();

            return redirect()->route('login')->with('error',
                'Your account is pending approval. Please wait for administrator approval.');
        }

        return $next($request);
    }
}
