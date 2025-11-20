<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Student;
use App\Mail\StudentPasswordResetMail;

class StudentPasswordResetController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotForm()
    {
        return view('loginRegisterSiswa.forgot-password');
    }

    /**
     * Send password reset link to student's email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Check if student exists
        $student = Student::where('email', $request->email)->first();

        if (!$student) {
            return back()->with('error', 'We could not find a student account with that email address.');
        }

        // Delete old tokens for this email
        DB::table('password_resets')
            ->where('email', $request->email)
            ->where('user_type', 'student')
            ->delete();

        // Generate new token
        $token = Str::random(64);

        // Store token in database
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'user_type' => 'student',
            'created_at' => Carbon::now()
        ]);

        // Send email with reset link
        try {
            Mail::to($request->email)->send(new StudentPasswordResetMail($token, $student->name));

            return back()->with('success', 'We have sent a password reset link to your email address!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email. Please try again later.');
        }
    }

    /**
     * Show reset password form
     */
    public function showResetForm($token)
    {
        return view('loginRegisterSiswa.reset-password', ['token' => $token]);
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|string'
        ]);

        // Find the token record
        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('user_type', 'student')
            ->first();

        if (!$resetRecord) {
            return back()->with('error', 'Invalid password reset token.');
        }

        // Check if token matches
        if (!Hash::check($request->token, $resetRecord->token)) {
            return back()->with('error', 'Invalid password reset token.');
        }

        // Check if token is expired (60 minutes)
        if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_resets')
                ->where('email', $request->email)
                ->where('user_type', 'student')
                ->delete();

            return back()->with('error', 'Password reset token has expired. Please request a new one.');
        }

        // Find student and update password
        $student = Student::where('email', $request->email)->first();

        if (!$student) {
            return back()->with('error', 'Student account not found.');
        }

        // Update password
        $student->password = Hash::make($request->password);
        $student->save();

        // Delete the token
        DB::table('password_resets')
            ->where('email', $request->email)
            ->where('user_type', 'student')
            ->delete();

        return redirect()->route('student.login')
            ->with('success', 'Your password has been reset successfully! You can now login with your new password.');
    }
}
