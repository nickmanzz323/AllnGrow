<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        // Normalize inputs: trim and lowercase email
        $request->merge([
            'email' => isset($request->email) ? trim(strtolower($request->email)) : null,
        ]);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'nullable',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
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
                return redirect()->route('student.login')->with('error', 'Invalid user level.');
            }

            // Redirect to the intended URL if present, otherwise to the role default
            return redirect()->intended($default);
        }

        return redirect()->route('student.login')->with('error', 'Invalid credentials.')->withInput($request->only('email'));
    }
}
