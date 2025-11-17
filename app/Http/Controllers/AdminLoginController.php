<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('loginAdmin.loginAdmin');
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

        // Cari admin berdasarkan email
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Login manual menggunakan guard admin
            Auth::guard('admin')->login($admin, $request->boolean('remember'));
            
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            Log::info('Admin login berhasil', ['admin_id' => $admin->id, 'email' => $admin->email]);

            // Redirect ke dashboard admin
            return redirect()->intended('/dashboardAdmin');
        }

        Log::warning('Admin login gagal', ['email' => $request->email]);

        return redirect()->back()
            ->with('error', 'Email atau password salah.')
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
