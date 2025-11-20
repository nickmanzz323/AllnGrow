<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Instructor;
use App\Mail\InstructorPasswordResetMail;

class InstructorPasswordResetController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotForm()
    {
        return view('loginRegisterInstructor.forgot-password');
    }

    /**
     * Send password reset link to instructor's email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Check if instructor exists
        $instructor = Instructor::where('email', $request->email)->first();

        if (!$instructor) {
            return back()->with('error', 'We could not find an instructor account with that email address.');
        }

        // Delete old tokens for this email
        DB::table('password_resets')
            ->where('email', $request->email)
            ->where('user_type', 'instructor')
            ->delete();

        // Generate new token
        $token = Str::random(64);

        // Store token in database
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'user_type' => 'instructor',
            'created_at' => Carbon::now()
        ]);

        // Send email with reset link
        try {
            Mail::to($request->email)->send(new InstructorPasswordResetMail($token, $instructor->name));

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
        return view('loginRegisterInstructor.reset-password', ['token' => $token]);
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
            ->where('user_type', 'instructor')
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
                ->where('user_type', 'instructor')
                ->delete();

            return back()->with('error', 'Password reset token has expired. Please request a new one.');
        }

        // Find instructor and update password
        $instructor = Instructor::where('email', $request->email)->first();

        if (!$instructor) {
            return back()->with('error', 'Instructor account not found.');
        }

        // Update password
        $instructor->password = Hash::make($request->password);
        $instructor->save();

        // Delete the token
        DB::table('password_resets')
            ->where('email', $request->email)
            ->where('user_type', 'instructor')
            ->delete();

        return redirect()->route('instructor.login')
            ->with('success', 'Your password has been reset successfully! You can now login with your new password.');
    }
}
