<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subcourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\InputSanitizer;

class InstructorCourseController extends Controller
{
    /**
     * Display dashboard dengan recent courses
     */
    public function dashboard()
    {
        try {
            $instructor = Auth::guard('instructor')->user();
            
            if (!$instructor) {
                return redirect()->route('instructor.login')->with('error', 'Please login first.');
            }

            // Get recent 5 courses
            $recentCourses = Course::where('instructorID', $instructor->id)
                ->withCount('subcourses')
                ->withCount('students')
                ->latest()
                ->take(5)
                ->get();

            // Get statistics
            $totalCourses = Course::where('instructorID', $instructor->id)->count();
            $totalStudents = Course::where('instructorID', $instructor->id)
                ->withCount('students')
                ->get()
                ->sum('students_count');

            return view('dashboardInstructor.dashboardInstructor', compact('recentCourses', 'totalCourses', 'totalStudents'));
        } catch (\Exception $e) {
            Log::error('Failed to load dashboard: ' . $e->getMessage());
            return view('dashboardInstructor.dashboardInstructor', [
                'recentCourses' => collect(),
                'totalCourses' => 0,
                'totalStudents' => 0
            ]);
        }
    }

    /**
     * Display form untuk create course baru
     */
    public function create()
    {
        try {
            return view('dashboardInstructor.createCourse');
        } catch (\Exception $e) {
            Log::error('Failed to load create course page: ' . $e->getMessage());
            return redirect()->route('dashboardinstructor')->with('error', 'Failed to load page. Error: ' . $e->getMessage());
        }
    }

    /**
     * Store course baru ke database
     */
    public function store(Request $request)
    {
        $instructor = Auth::guard('instructor')->user();

        // Validasi input
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'description' => 'nullable|string|max:5000',
            
            // Subcourses (optional, multiple)
            'subcourses' => 'nullable|array',
            'subcourses.*.title' => 'required|string|max:255',
            'subcourses.*.content' => 'nullable|string|max:10000',
            'subcourses.*.thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'subcourses.*.fileUpload' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,mov,avi|max:51200',
        ]);

        try {
            // Upload thumbnail jika ada
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            }

            // Buat course
            $course = Course::create([
                'instructorID' => $instructor->id,
                'title' => InputSanitizer::sanitizeText($data['title']),
                'price' => $data['price'],
                'thumbnail' => $thumbnailPath,
            ]);

            // Buat subcourses jika ada
            if (isset($data['subcourses']) && is_array($data['subcourses'])) {
                foreach ($data['subcourses'] as $index => $subcourseData) {
                    $subThumbnail = null;
                    $subFile = null;

                    // Upload subcourse thumbnail
                    if (isset($request->subcourses[$index]['thumbnail'])) {
                        $file = $request->file("subcourses.{$index}.thumbnail");
                        if ($file) {
                            $subThumbnail = $file->store("courses/{$course->id}/subcourses/thumbnails", 'public');
                        }
                    }

                    // Upload subcourse file
                    if (isset($request->subcourses[$index]['fileUpload'])) {
                        $file = $request->file("subcourses.{$index}.fileUpload");
                        if ($file) {
                            $subFile = $file->store("courses/{$course->id}/subcourses/files", 'public');
                        }
                    }

                    Subcourse::create([
                        'course_id' => $course->id,
                        'title' => InputSanitizer::sanitizeText($subcourseData['title']),
                        'content' => isset($subcourseData['content']) ? InputSanitizer::sanitizeHtml($subcourseData['content']) : null,
                        'thumbnail' => $subThumbnail,
                        'fileUpload' => $subFile,
                    ]);
                }
            }

            Log::info('Course created successfully', [
                'instructor_id' => $instructor->id,
                'course_id' => $course->id,
                'title' => $course->title,
            ]);

            return redirect()->route('instructor.courses.index')->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create course: ' . $e->getMessage(), [
                'instructor_id' => $instructor->id,
                'exception' => $e,
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to create course. Please try again.');
        }
    }

    /**
     * Display list courses milik instructor
     */
    public function index()
    {
        try {
            $instructor = Auth::guard('instructor')->user();
            
            if (!$instructor) {
                return redirect()->route('instructor.login')->with('error', 'Please login first.');
            }

            $courses = Course::where('instructorID', $instructor->id)
                ->withCount('subcourses')
                ->withCount('students')
                ->latest()
                ->paginate(10);

            return view('dashboardInstructor.myCourses', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Failed to load courses: ' . $e->getMessage());
            return redirect()->route('dashboardinstructor')->with('error', 'Failed to load courses. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display detail course untuk edit
     */
    public function edit($id)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)
            ->with('subcourses')
            ->findOrFail($id);

        return view('dashboardInstructor.editCourse', compact('course'));
    }

    /**
     * Update course
     */
    public function update(Request $request, $id)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($id);

        // Validasi input
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
        ]);

        try {
            // Upload thumbnail baru jika ada
            if ($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama
                if ($course->thumbnail) {
                    Storage::disk('public')->delete($course->thumbnail);
                }
                $data['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            }

            // Update course
            $course->update([
                'title' => InputSanitizer::sanitizeText($data['title']),
                'price' => $data['price'],
                'thumbnail' => $data['thumbnail'] ?? $course->thumbnail,
            ]);

            Log::info('Course updated successfully', [
                'instructor_id' => $instructor->id,
                'course_id' => $course->id,
            ]);

            return redirect()->route('instructor.courses.index')->with('success', 'Course updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update course: ' . $e->getMessage(), [
                'course_id' => $id,
                'exception' => $e,
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to update course. Please try again.');
        }
    }

    /**
     * Delete course
     */
    public function destroy($id)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($id);

        try {
            // Hapus thumbnail
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            // Hapus subcourses files
            foreach ($course->subcourses as $subcourse) {
                if ($subcourse->thumbnail) {
                    Storage::disk('public')->delete($subcourse->thumbnail);
                }
                if ($subcourse->fileUpload) {
                    Storage::disk('public')->delete($subcourse->fileUpload);
                }
            }

            $course->delete();

            Log::info('Course deleted successfully', [
                'instructor_id' => $instructor->id,
                'course_id' => $course->id,
            ]);

            return redirect()->route('instructor.courses.index')->with('success', 'Course deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete course: ' . $e->getMessage(), [
                'course_id' => $id,
                'exception' => $e,
            ]);
            return redirect()->back()->with('error', 'Failed to delete course. Please try again.');
        }
    }

    /**
     * Store subcourse baru untuk course
     */
    public function storeSubcourse(Request $request, $courseId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:10000',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'fileUpload' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,mov,avi|max:51200',
        ]);

        try {
            $thumbnailPath = null;
            $filePath = null;

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store("courses/{$courseId}/subcourses/thumbnails", 'public');
            }

            if ($request->hasFile('fileUpload')) {
                $filePath = $request->file('fileUpload')->store("courses/{$courseId}/subcourses/files", 'public');
            }

            Subcourse::create([
                'course_id' => $courseId,
                'title' => InputSanitizer::sanitizeText($data['title']),
                'content' => isset($data['content']) ? InputSanitizer::sanitizeHtml($data['content']) : null,
                'thumbnail' => $thumbnailPath,
                'fileUpload' => $filePath,
            ]);

            Log::info('Subcourse created', ['course_id' => $courseId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Module added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create subcourse: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to add module. Please try again.');
        }
    }

    /**
     * Update subcourse
     */
    public function updateSubcourse(Request $request, $courseId, $subcourseId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);
        $subcourse = Subcourse::where('course_id', $courseId)->findOrFail($subcourseId);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:10000',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'fileUpload' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,mov,avi|max:51200',
        ]);

        try {
            if ($request->hasFile('thumbnail')) {
                if ($subcourse->thumbnail) {
                    Storage::disk('public')->delete($subcourse->thumbnail);
                }
                $data['thumbnail'] = $request->file('thumbnail')->store("courses/{$courseId}/subcourses/thumbnails", 'public');
            }

            if ($request->hasFile('fileUpload')) {
                if ($subcourse->fileUpload) {
                    Storage::disk('public')->delete($subcourse->fileUpload);
                }
                $data['fileUpload'] = $request->file('fileUpload')->store("courses/{$courseId}/subcourses/files", 'public');
            }

            $subcourse->update([
                'title' => InputSanitizer::sanitizeText($data['title']),
                'content' => isset($data['content']) ? InputSanitizer::sanitizeHtml($data['content']) : null,
                'thumbnail' => $data['thumbnail'] ?? $subcourse->thumbnail,
                'fileUpload' => $data['fileUpload'] ?? $subcourse->fileUpload,
            ]);

            Log::info('Subcourse updated', ['subcourse_id' => $subcourseId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Module updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update subcourse: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update module. Please try again.');
        }
    }

    /**
     * Delete subcourse
     */
    public function destroySubcourse($courseId, $subcourseId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);
        $subcourse = Subcourse::where('course_id', $courseId)->findOrFail($subcourseId);

        try {
            if ($subcourse->thumbnail) {
                Storage::disk('public')->delete($subcourse->thumbnail);
            }
            if ($subcourse->fileUpload) {
                Storage::disk('public')->delete($subcourse->fileUpload);
            }

            $subcourse->delete();

            Log::info('Subcourse deleted', ['subcourse_id' => $subcourseId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Module deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete subcourse: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete module. Please try again.');
        }
    }
}
