<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if authenticated user is an admin
        if (Auth::user()->usertype !== 'admin') {
            // Redirect non-admin users with an error message
            return redirect()->route('dashboard')->with('error', 'Unauthorized access. Admin privileges required.');
        }

        return $next($request);
    }
}
