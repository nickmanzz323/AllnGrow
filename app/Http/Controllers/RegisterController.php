<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentDetail;
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
            'email' => 'required|string|email|max:255|unique:students,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            // Create student account
            $student = Student::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // Create student detail record (fullname, phone, bio)
            StudentDetail::create([
                'studentID' => $student->id,
                'fullname' => InputSanitizer::sanitizeText($data['name']),
                'phone' => $request->input('phone') ? InputSanitizer::sanitizeText($request->input('phone')) : null,
                'bio' => $request->input('bio') ? InputSanitizer::sanitizeHtml($request->input('bio')) : null,
            ]);

            return redirect()->route('student.login')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            Log::error('Student registration failed: '.$e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again later.');
        }
    }
}
