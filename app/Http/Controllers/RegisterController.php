<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Services\InputSanitizer;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Normalize inputs: trim whitespace and lowercase email
        $request->merge([
            'email' => isset($request->email) ? trim(strtolower($request->email)) : null,
            'name' => isset($request->name) ? trim($request->name) : null,
        ]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = User::create([
                'name' => InputSanitizer::sanitizeText($data['name']),
                'email' => $data['email'],
                'level' => 'student',
                'password' => Hash::make($data['password']),
            ]);

            // Redirect to login with a success message
            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            // Log the exception for debugging and show a generic error to the user
            Log::error('Registration failed: '.$e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again later.');
        }
    }
}
