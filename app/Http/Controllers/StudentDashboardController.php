<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentDashboardController extends Controller
{
    /**
     * Display student dashboard
     */
    public function index()
    {
        try {
            $student = Auth::guard('student')->user();
            
            if (!$student) {
                return redirect()->route('student.login')->with('error', 'Please login first.');
            }

            // Load student detail
            $student->load('detail');

            // Get enrolled courses with details
            $enrolledCourses = $student->courses()
                ->with(['instructor.detail', 'subcourses'])
                ->withPivot(['completion', 'completed', 'payment_status', 'created_at'])
                ->get();

            // Calculate statistics
            $totalCourses = $enrolledCourses->count();
            $completedCourses = $enrolledCourses->where('pivot.completed', true)->count();
            $inProgressCourses = $totalCourses - $completedCourses;
            $averageCompletion = $totalCourses > 0 
                ? round($enrolledCourses->avg('pivot.completion'), 1) 
                : 0;

            return view('dashboardSiswa.dashboardSiswa', compact(
                'student',
                'enrolledCourses',
                'totalCourses',
                'completedCourses',
                'inProgressCourses',
                'averageCompletion'
            ));
        } catch (\Exception $e) {
            Log::error('Failed to load student dashboard: ' . $e->getMessage());
            return view('dashboardSiswa.dashboardSiswa', [
                'student' => Auth::guard('student')->user(),
                'enrolledCourses' => collect(),
                'totalCourses' => 0,
                'completedCourses' => 0,
                'inProgressCourses' => 0,
                'averageCompletion' => 0
            ]);
        }
    }

    /**
     * Display browse/find courses page
     */
    public function browseCourses(Request $request)
    {
        $student = Auth::guard('student')->user();
        $student->load('detail');
        
        // Get all categories for filter
        $categories = Category::all();
        
        // Build query - simplified without complex eager loading
        $query = Course::where('status', 'approved');
        
        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        // Filter by price
        if ($request->filled('price_filter')) {
            switch ($request->price_filter) {
                case 'free':
                    $query->where('price', 0);
                    break;
                case 'paid':
                    $query->where('price', '>', 0);
                    break;
            }
        }
        
        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->withCount('students')->orderBy('students_count', 'desc');
                break;
            default: // latest
                $query->latest();
        }
        
        $courses = $query->paginate(12);
        
        // Load relationships after pagination
        $courses->load(['instructor', 'category', 'subcourses']);
        
        // Get enrolled course IDs - specify table prefix to avoid ambiguity
        $enrolledCourseIds = $student->courses()->pluck('courses.courseID')->toArray();
        
        return view('dashboardSiswa.browseCourses', compact(
            'student',
            'courses',
            'categories',
            'enrolledCourseIds'
        ));
    }

    /**
     * Enroll student to course
     */
    public function enrollCourse(Request $request, $courseId)
    {
        try {
            $student = Auth::guard('student')->user();
            $course = Course::findOrFail($courseId);
            
            // Check if already enrolled - use wherePivot for pivot table columns
            if ($student->courses()->wherePivot('courseID', $courseId)->exists()) {
                return redirect()->back()->with('error', 'You are already enrolled in this course.');
            }
            
            // Check if course is approved
            if ($course->status !== 'approved') {
                return redirect()->back()->with('error', 'This course is not available for enrollment.');
            }
            
            // Enroll with pending payment status - use course's primary key
            $student->courses()->attach($course->courseID, [
                'completion' => 0,
                'completed' => false,
                'payment_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            Log::info('Student enrolled in course', [
                'student_id' => $student->id,
                'course_id' => $course->courseID,
                'payment_status' => 'pending'
            ]);
            
            return redirect()->route('student.my-courses')->with('success', 'Successfully enrolled! Please wait for instructor to confirm your payment.');
        } catch (\Exception $e) {
            Log::error('Failed to enroll course: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to enroll in course.');
        }
    }

    /**
     * Display student's enrolled courses
     */
    public function myCourses()
    {
        try {
            $student = Auth::guard('student')->user();
            $student->load('detail');
            
            $enrolledCourses = $student->courses()
                ->with(['instructor', 'category', 'subcourses'])
                ->withPivot(['completion', 'completed', 'payment_status', 'created_at'])
                ->orderBy('student_course.created_at', 'desc')
                ->get();
            
            
            return view('dashboardSiswa.myCourses', compact('student', 'enrolledCourses'));
        } catch (\Exception $e) {
            Log::error('Failed to load my courses: ' . $e->getMessage());
            return view('dashboardSiswa.myCourses', [
                'student' => Auth::guard('student')->user(),
                'enrolledCourses' => collect()
            ]);
        }
    }

    /**
     * Display course detail with subcourses
     */
    public function viewCourse($courseId)
    {
        try {
            $student = Auth::guard('student')->user();
            $student->load('detail');
            
            // Check if student is enrolled in this course - use wherePivot
            $enrollment = $student->courses()
                ->wherePivot('courseID', $courseId)
                ->withPivot(['completion', 'completed', 'payment_status'])
                ->first();
            
            if (!$enrollment) {
                return redirect()->route('student.my-courses')->with('error', 'You are not enrolled in this course.');
            }
            
            // Check payment status
            if ($enrollment->pivot->payment_status === 'pending') {
                return redirect()->route('student.my-courses')->with('error', 'Please wait for payment confirmation before accessing the course.');
            }
            
            // Load course with all related data - remove instructor.detail to avoid issues
            $course = Course::with(['instructor', 'category', 'subcourses' => function($query) {
                $query->orderBy('order', 'asc');
            }])->findOrFail($courseId);
            
            // Lazy load instructor detail if exists
            if ($course->instructor) {
                $course->instructor->load('detail');
            }
            
            return view('dashboardSiswa.courseDetail', compact('student', 'course', 'enrollment'));
        } catch (\Exception $e) {
            Log::error('Failed to load course detail: ' . $e->getMessage());
            return redirect()->route('student.my-courses')->with('error', 'Failed to load course.');
        }
    }

    /**
     * Display settings page
     */
    public function settings()
    {
        $student = Auth::guard('student')->user();
        $student->load('detail');
        return view('dashboardSiswa.settings', compact('student'));
    }

    /**
     * Update profile information
     */
    public function updateProfile(Request $request)
    {
        try {
            $student = Auth::guard('student')->user();
            
            $request->validate([
                'fullname' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'gender' => 'required|in:male,female',
                'dob' => 'required|date',
                'country' => 'required|string|max:100',
            ]);

            $student->detail()->updateOrCreate(
                ['studentID' => $student->id],
                [
                    'fullname' => $request->fullname,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'country' => $request->country,
                ]
            );

            return redirect()->route('settings')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        try {
            $student = Auth::guard('student')->user();
            
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if (!\Hash::check($request->current_password, $student->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            $student->update([
                'password' => \Hash::make($request->new_password)
            ]);

            return redirect()->route('settings')->with('success', 'Password updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update password: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update password.');
        }
    }

    /**
     * Delete account
     */
    public function deleteAccount(Request $request)
    {
        try {
            $student = Auth::guard('student')->user();

            $request->validate([
                'password' => 'required',
            ]);

            if (!\Hash::check($request->password, $student->password)) {
                return redirect()->back()->with('error', 'Password is incorrect.');
            }

            // Delete student detail first
            $student->detail()->delete();

            // Detach all courses
            $student->courses()->detach();

            // Delete student account
            $student->delete();

            // Logout
            Auth::guard('student')->logout();

            return redirect()->route('student.login')->with('success', 'Account deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete account: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete account.');
        }
    }

    /**
     * Display schedule page with enrolled courses
     */
    public function schedule()
    {
        try {
            $student = Auth::guard('student')->user();
            $student->load('detail');

            // Get enrolled courses with paid status
            $enrolledCourses = $student->courses()
                ->with(['instructor.detail', 'subcourses'])
                ->wherePivot('payment_status', 'paid')
                ->withPivot(['completion', 'completed', 'payment_status', 'created_at'])
                ->get();

            return view('dashboardSiswa.schedule', compact('student', 'enrolledCourses'));
        } catch (\Exception $e) {
            Log::error('Failed to load schedule: ' . $e->getMessage());
            return view('dashboardSiswa.schedule', [
                'student' => Auth::guard('student')->user(),
                'enrolledCourses' => collect()
            ]);
        }
    }

    /**
     * Display progress page with enrolled courses statistics
     */
    public function progress()
    {
        try {
            $student = Auth::guard('student')->user();
            $student->load('detail');

            // Get enrolled courses with details
            $enrolledCourses = $student->courses()
                ->with(['instructor.detail', 'subcourses'])
                ->wherePivot('payment_status', 'paid')
                ->withPivot(['completion', 'completed', 'payment_status', 'created_at'])
                ->orderBy('student_course.created_at', 'desc')
                ->get();

            // Calculate statistics
            $totalCourses = $enrolledCourses->count();
            $completedCourses = $enrolledCourses->where('pivot.completed', true)->count();
            $inProgressCourses = $totalCourses - $completedCourses;
            $averageCompletion = $totalCourses > 0
                ? round($enrolledCourses->avg('pivot.completion'), 1)
                : 0;

            // Calculate achievements
            $achievements = [];

            if ($completedCourses >= 1) {
                $achievements[] = [
                    'title' => 'First Course Complete',
                    'description' => 'Completed your first course',
                    'icon' => 'fa-trophy',
                    'color' => '#4ade80',
                    'earned' => true,
                    'date' => $enrolledCourses->where('pivot.completed', true)->first()->pivot->updated_at ?? null
                ];
            }

            if ($completedCourses >= 5) {
                $achievements[] = [
                    'title' => 'Course Master',
                    'description' => 'Completed 5 courses',
                    'icon' => 'fa-star',
                    'color' => '#fbbf24',
                    'earned' => true,
                    'date' => now()
                ];
            }

            if ($completedCourses >= 10) {
                $achievements[] = [
                    'title' => 'Learning Expert',
                    'description' => 'Completed 10 courses',
                    'icon' => 'fa-medal',
                    'color' => '#ef4444',
                    'earned' => true,
                    'date' => now()
                ];
            }

            if ($averageCompletion >= 80) {
                $achievements[] = [
                    'title' => 'Dedicated Learner',
                    'description' => 'Maintained 80% average completion',
                    'icon' => 'fa-fire',
                    'color' => '#f97316',
                    'earned' => true,
                    'date' => now()
                ];
            }

            return view('dashboardSiswa.progress', compact(
                'student',
                'enrolledCourses',
                'totalCourses',
                'completedCourses',
                'inProgressCourses',
                'averageCompletion',
                'achievements'
            ));
        } catch (\Exception $e) {
            Log::error('Failed to load progress: ' . $e->getMessage());
            return view('dashboardSiswa.progress', [
                'student' => Auth::guard('student')->user(),
                'enrolledCourses' => collect(),
                'totalCourses' => 0,
                'completedCourses' => 0,
                'inProgressCourses' => 0,
                'averageCompletion' => 0,
                'achievements' => []
            ]);
        }
    }
}

