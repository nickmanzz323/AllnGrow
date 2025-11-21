<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('loginRegisterSiswa.login');
    }

    public function login(Request $request)
    {
        // Normalize inputs: trim dan lowercase email
        $request->merge([
            'email' => isset($request->email) ? trim(strtolower($request->email)) : null,
        ]);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'nullable',
        ]);

        // Cari student berdasarkan email
        $student = Student::where('email', $request->email)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            // Login manual menggunakan guard student
            Auth::guard('student')->login($student, $request->boolean('remember'));
            
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            Log::info('Student login berhasil', ['student_id' => $student->id, 'email' => $student->email]);

            // Redirect ke dashboard student
            return redirect()->intended('/dashboardSiswa');
        }

        Log::warning('Student login gagal', ['email' => $request->email]);

        return redirect()->route('student.login')
            ->with('error', 'Email atau password salah.')
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login')->with('success', 'Berhasil logout.');
    }
}
