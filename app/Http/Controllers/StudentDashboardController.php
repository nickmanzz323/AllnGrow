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
        try {
            $student = Auth::guard('student')->user();
            
            // Get all categories for filter
            $categories = Category::all();
            
            // Build query
            $query = Course::with(['instructor.detail', 'category', 'subcourses'])
                ->where('status', 'approved'); // Only show approved courses
            
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
            
            // Get enrolled course IDs
            $enrolledCourseIds = $student->courses()->pluck('courses.id')->toArray();
            
            return view('dashboardSiswa.browseCourses', compact(
                'student',
                'courses',
                'categories',
                'enrolledCourseIds'
            ));
        } catch (\Exception $e) {
            Log::error('Failed to load browse courses: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load courses.');
        }
    }

    /**
     * Enroll student to course
     */
    public function enrollCourse(Request $request, $courseId)
    {
        try {
            $student = Auth::guard('student')->user();
            $course = Course::findOrFail($courseId);
            
            // Check if already enrolled
            if ($student->courses()->where('course_id', $courseId)->exists()) {
                return redirect()->back()->with('error', 'You are already enrolled in this course.');
            }
            
            // Check if course is approved
            if ($course->status !== 'approved') {
                return redirect()->back()->with('error', 'This course is not available for enrollment.');
            }
            
            // Enroll with pending payment status
            $student->courses()->attach($courseId, [
                'completion' => 0,
                'completed' => false,
                'payment_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            Log::info('Student enrolled in course', [
                'student_id' => $student->id,
                'course_id' => $courseId,
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
            
            $enrolledCourses = $student->courses()
                ->with(['instructor.detail', 'category', 'subcourses'])
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
}
