<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Prevent session fixation
            $request->session()->regenerate();

            $user = Auth::user();

            // Choose a sensible default based on role
            if ($user->level === 'teacher') {
                $default = '/teacherDashboard';
            } elseif ($user->level === 'student') {
                $default = '/studentDashboard';
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['level' => 'Invalid user level.']);
            }

            // Redirect to the intended URL if present, otherwise to the role default
            return redirect()->intended($default);
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.'])->withInput($request->only('email'));
    }
}
