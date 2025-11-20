<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\InstructorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\InputSanitizer;

class InstructorRegisterController extends Controller
{
    /**
     * Step 1: Register dengan nama, email, password
     * Setelah berhasil, redirect ke form detail (step 2)
     */
    public function registerStep1(Request $request)
    {
        // Normalize common inputs
        $request->merge([
            'email' => isset($request->email) ? trim(strtolower($request->email)) : null,
            'name' => isset($request->name) ? trim($request->name) : null,
        ]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:instructors,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            // Buat instructor account
            $instructor = Instructor::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // Simpan data sementara di session untuk step 2
            session([
                'instructor_temp_id' => $instructor->id,
                'instructor_temp_name' => $data['name'],
            ]);

            // Redirect ke form detail (step 2)
            return redirect()->route('registerInstructorForm')->with('success', 'Account created! Please complete your profile.');
        } catch (\Exception $e) {
            Log::error('Instructor registration step 1 failed: '.$e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again later.');
        }
    }

    /**
     * Step 2: Lengkapi detail profile (opsional semua field)
     * Setelah submit, simpan ke instructor_details dan redirect ke login
     */
    public function registerStep2(Request $request)
    {
        // Ambil instructor ID dari session
        $instructorId = session('instructor_temp_id');
        $instructorName = session('instructor_temp_name');

        if (!$instructorId) {
            return redirect()->route('registerInstructor')->with('error', 'Session expired. Please register again.');
        }

        // Validasi fields (semua opsional)
        $data = $request->validate([
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:30',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:2000',
            'expertise' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'linkedin' => 'nullable|url|max:255',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        try {
            $stored = [];

            // Store CV jika ada dengan enhanced MIME type verification
            if ($request->hasFile('cv')) {
                $file = $request->file('cv');

                // Verify actual MIME type, not just extension
                $mimeType = $file->getMimeType();
                $allowedMimes = [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!in_array($mimeType, $allowedMimes)) {
                    return redirect()->back()
                        ->with('error', 'Invalid file type. Only PDF and DOC files are allowed.')
                        ->withInput();
                }

                // Sanitize path to prevent path traversal
                $sanitizedPath = 'instructors/' . intval($instructorId) . '/cv';
                $path = $file->store($sanitizedPath, 'public');
                $stored['cv'] = $path;
            }

            // Buat instructor detail
            $detail = [
                'instructorID' => $instructorId,
                'fullname' => InputSanitizer::sanitizeText($instructorName),
                'phone' => isset($data['phone']) ? InputSanitizer::sanitizeText($data['phone']) : null,
                'gender' => $data['gender'] ?? null,
                'dob' => $data['dob'] ?? null,
                'bio' => isset($data['bio']) ? InputSanitizer::sanitizeHtml($data['bio']) : null,
                'country' => isset($data['country']) ? InputSanitizer::sanitizeText($data['country']) : null,
                'expertise' => isset($data['expertise']) ? InputSanitizer::sanitizeText($data['expertise']) : null,
                'yearsOfExperience' => $data['years_experience'] ?? null,
                'linkedin' => isset($data['linkedin']) ? trim($data['linkedin']) : null,
                'cv' => $stored['cv'] ?? null,
                'status' => 'pending',
            ];

            InstructorDetail::create($detail);

            // Clear session
            session()->forget(['instructor_temp_id', 'instructor_temp_name']);

            Log::info('Instructor registration completed', ['instructor_id' => $instructorId]);

            return redirect()->route('instructor.login')->with('success', 'Registration completed! Your account will be reviewed by admin.');
        } catch (\Exception $e) {
            Log::error('Instructor registration step 2 failed: '.$e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Failed to save profile. Please try again.');
        }
    }
}
