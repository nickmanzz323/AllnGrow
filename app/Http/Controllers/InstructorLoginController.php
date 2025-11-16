<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class InstructorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('loginRegisterInstructor.loginInstructor');
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

        // Cari instructor berdasarkan email
        $instructor = Instructor::where('email', $request->email)->first();

        if ($instructor && Hash::check($request->password, $instructor->password)) {
            // Cek status approval dari instructor_details (jika ada)
            $detail = $instructor->detail;
            
            if ($detail && $detail->status === 'rejected') {
                return redirect()->back()
                    ->with('error', 'Akun Anda ditolak. Silakan hubungi administrator.')
                    ->withInput($request->only('email'));
            }

            if ($detail && $detail->status === 'pending') {
                return redirect()->back()
                    ->with('error', 'Akun Anda masih dalam proses review. Mohon tunggu persetujuan admin.')
                    ->withInput($request->only('email'));
            }

            // Login manual menggunakan guard instructor
            Auth::guard('instructor')->login($instructor, $request->boolean('remember'));
            
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            Log::info('Instructor login berhasil', ['instructor_id' => $instructor->id, 'email' => $instructor->email]);

            // Redirect ke dashboard instructor
            return redirect()->intended('/dashboardInstructor');
        }

        Log::warning('Instructor login gagal', ['email' => $request->email]);

        return redirect()->back()
            ->with('error', 'Email atau password salah.')
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('instructor.login')->with('success', 'Berhasil logout.');
    }
}
