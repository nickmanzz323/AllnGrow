<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateInstructor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('instructor')->check()) {
            return redirect()->route('instructor.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
