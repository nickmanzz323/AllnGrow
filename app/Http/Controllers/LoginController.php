<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level === 'teacher') {
                return redirect('/teacherDashboard');
            } elseif ($user->level === 'student') {
                return redirect('/studentDashboard');
            } else {
                Auth::logout();
                return redirect('/login')->withErrors(['level' => 'Invalid user level.']);
            }
        } else {
            return redirect('/login')->withErrors(['email' => 'Invalid credentials.']);
        }
    }
}
