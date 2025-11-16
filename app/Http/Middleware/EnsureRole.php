<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureRole
{
    /**
     * Handle an incoming request.
     * Accepts a comma-separated list of allowed roles, e.g. 'teacher' or 'student,teacher'.
     */
    public function handle(Request $request, Closure $next, $roles = null)
    {
        if (! Auth::check()) {
            // Not authenticated — let auth middleware handle redirect. Return login.
            return redirect()->route('student.login');
        }

        $user = Auth::user();

        if ($roles === null) {
            // No specific role required
            return $next($request);
        }

        $allowed = array_map('trim', explode(',', $roles));

        if (! in_array($user->level, $allowed, true)) {
            // If user is authenticated but not allowed, redirect them to their dashboard
            if ($user->level === 'teacher') {
                return redirect('/teacherDashboard')->with('error', 'You do not have access to that page.');
            }

            return redirect('/studentDashboard')->with('error', 'You do not have access to that page.');
        }

        return $next($request);
    }
}
