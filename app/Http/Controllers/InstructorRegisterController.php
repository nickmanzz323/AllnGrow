<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\InputSanitizer;

class InstructorRegisterController extends Controller
{
    /**
     * Handle instructor registration.
     *
     * Assumptions:
     * - The form submits fields named: name, email, password, password_confirmation,
     *   gender, dob (date_of_birth), phone, country, bio, expertise, years_experience,
     *   linkedin, profile_photo, cv, certifications[]
     */
    public function register(Request $request)
    {
        // Normalize common inputs
        $request->merge([
            'email' => isset($request->email) ? trim(strtolower($request->email)) : null,
            'name' => isset($request->name) ? trim($request->name) : null,
        ]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',

            // Profile / optional fields
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:30',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:2000',
            'expertise' => 'required|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'linkedin' => 'nullable|url|max:255',

            // Files
            'profile_photo' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'certifications' => 'nullable|array',
            'certifications.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        try {
            $user = User::create([
                'name' => InputSanitizer::sanitizeText($data['name']),
                'email' => $data['email'],
                'level' => 'teacher',
                'password' => Hash::make($data['password']),
            ]);

            $stored = [];

            // store profile photo
            if ($request->hasFile('profile_photo')) {
                $path = $request->file('profile_photo')->store('instructors/'.$user->id.'/photos', 'public');
                $stored['profile_photo'] = $path;
            }

            // store CV
            if ($request->hasFile('cv')) {
                $path = $request->file('cv')->store('instructors/'.$user->id.'/cv', 'public');
                $stored['cv'] = $path;
            }

            // store certifications (multiple)
            if ($request->hasFile('certifications')) {
                $certs = [];
                foreach ($request->file('certifications') as $file) {
                    if ($file && $file->isValid()) {
                        $certs[] = $file->store('instructors/'.$user->id.'/certifications', 'public');
                    }
                }
                $stored['certifications'] = $certs;
            }

            // Log stored file paths so admins or future migrations can pick them up.
            if (!empty($stored)) {
                Log::info('Instructor registration stored files', ['user_id' => $user->id, 'files' => $stored]);
            }

            // persist profile fields to the user record
            $profile = [];
            $profile['gender'] = $data['gender'] ?? null;
            $profile['dob'] = $data['dob'] ?? null;
            $profile['phone'] = isset($data['phone']) ? InputSanitizer::sanitizeText($data['phone']) : null;
            $profile['country'] = isset($data['country']) ? InputSanitizer::sanitizeText($data['country']) : null;
            $profile['bio'] = isset($data['bio']) ? InputSanitizer::sanitizeHtml($data['bio']) : null;
            $profile['expertise'] = isset($data['expertise']) ? InputSanitizer::sanitizeText($data['expertise']) : null;
            $profile['years_experience'] = $data['years_experience'] ?? null;
            $profile['linkedin'] = isset($data['linkedin']) ? trim($data['linkedin']) : null;
            $profile['profile_photo'] = $stored['profile_photo'] ?? null;
            $profile['cv'] = $stored['cv'] ?? null;
            $profile['certifications'] = $stored['certifications'] ?? null;

            $user->update($profile);

            // Optionally, you may want to flag teacher accounts for manual approval. For now
            // we simply redirect to login with a success message.
            return redirect()->route('login')->with('success', 'Instructor registration successful. Please log in.');
        } catch (\Exception $e) {
            Log::error('Instructor registration failed: '.$e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again later.');
        }
    }
}
