<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\CourseSession;
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

            // Load instructor detail
            $instructor->load('detail');

            // Get recent 5 courses
            $recentCourses = Course::where('instructorID', $instructor->id)
                ->withCount('chapters')
                ->withCount('lessons')
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

            return view('dashboardInstructor.dashboardInstructor', compact('instructor', 'recentCourses', 'totalCourses', 'totalStudents'));
        } catch (\Exception $e) {
            Log::error('Failed to load dashboard: ' . $e->getMessage());
            $instructor = Auth::guard('instructor')->user();
            return view('dashboardInstructor.dashboardInstructor', [
                'instructor' => $instructor,
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
            $categories = \App\Models\Category::all();
            return view('dashboardInstructor.createCourse', compact('categories'));
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
            'category_id' => 'nullable|exists:categories,id',

            // Teaching mode fields
            'teaching_mode' => 'required|in:static,online,offline,hybrid',
            'meeting_platform' => 'nullable|string|max:50',
            'default_meeting_link' => 'nullable|url|max:500',
            'location_name' => 'nullable|string|max:255',
            'location_address' => 'nullable|string|max:1000',
            'location_city' => 'nullable|string|max:100',
            'max_participants' => 'nullable|integer|min:1',

            // Chapters (Bab)
            'chapters' => 'nullable|array',
            'chapters.*.title' => 'required_with:chapters|string|max:255',
            'chapters.*.description' => 'nullable|string|max:2000',

            // Lessons within chapters
            'chapters.*.lessons' => 'nullable|array',
            'chapters.*.lessons.*.title' => 'required_with:chapters.*.lessons|string|max:255',
            'chapters.*.lessons.*.content' => 'nullable|string|max:10000',
            'chapters.*.lessons.*.video_url' => 'nullable|url|max:500',
            'chapters.*.lessons.*.duration' => 'nullable|integer|min:0',
            'chapters.*.lessons.*.is_free' => 'nullable|boolean',
            'chapters.*.lessons.*.thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'chapters.*.lessons.*.fileUpload' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,mov,avi|max:51200',

            // Sessions for live courses
            'sessions' => 'nullable|array',
            'sessions.*.title' => 'required_with:sessions|string|max:255',
            'sessions.*.start_time' => 'required_with:sessions|date',
            'sessions.*.end_time' => 'required_with:sessions|date|after:sessions.*.start_time',
            'sessions.*.session_type' => 'nullable|in:online,offline',
            'sessions.*.meeting_link' => 'nullable|string|max:500',
            'sessions.*.description' => 'nullable|string|max:1000',
        ]);

        try {
            // Upload thumbnail jika ada
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            }

            // Buat course dengan status pending
            $course = Course::create([
                'instructorID' => $instructor->id,
                'category_id' => $data['category_id'] ?? null,
                'title' => InputSanitizer::sanitizeText($data['title']),
                'description' => isset($data['description']) ? InputSanitizer::sanitizeHtml($data['description']) : null,
                'price' => $data['price'],
                'thumbnail' => $thumbnailPath,
                'status' => 'pending',
                // Teaching mode fields
                'teaching_mode' => $data['teaching_mode'],
                'meeting_platform' => $data['meeting_platform'] ?? null,
                'default_meeting_link' => $data['default_meeting_link'] ?? null,
                'location_name' => isset($data['location_name']) ? InputSanitizer::sanitizeText($data['location_name']) : null,
                'location_address' => isset($data['location_address']) ? InputSanitizer::sanitizeText($data['location_address']) : null,
                'location_city' => isset($data['location_city']) ? InputSanitizer::sanitizeText($data['location_city']) : null,
                'max_participants' => $data['max_participants'] ?? null,
            ]);

            // Buat chapters dan lessons jika ada
            if (isset($data['chapters']) && is_array($data['chapters'])) {
                foreach ($data['chapters'] as $chapterIndex => $chapterData) {
                    $chapter = Chapter::create([
                        'course_id' => $course->courseID,
                        'title' => InputSanitizer::sanitizeText($chapterData['title']),
                        'description' => isset($chapterData['description']) ? InputSanitizer::sanitizeText($chapterData['description']) : null,
                        'order' => $chapterIndex + 1,
                    ]);

                    // Buat lessons dalam chapter
                    if (isset($chapterData['lessons']) && is_array($chapterData['lessons'])) {
                        foreach ($chapterData['lessons'] as $lessonIndex => $lessonData) {
                            $lessonThumbnail = null;
                            $lessonFile = null;

                            // Upload lesson thumbnail
                            if ($request->hasFile("chapters.{$chapterIndex}.lessons.{$lessonIndex}.thumbnail")) {
                                $lessonThumbnail = $request->file("chapters.{$chapterIndex}.lessons.{$lessonIndex}.thumbnail")
                                    ->store("courses/{$course->courseID}/lessons/thumbnails", 'public');
                            }

                            // Upload lesson file
                            if ($request->hasFile("chapters.{$chapterIndex}.lessons.{$lessonIndex}.fileUpload")) {
                                $lessonFile = $request->file("chapters.{$chapterIndex}.lessons.{$lessonIndex}.fileUpload")
                                    ->store("courses/{$course->courseID}/lessons/files", 'public');
                            }

                            Lesson::create([
                                'chapter_id' => $chapter->id,
                                'course_id' => $course->courseID,
                                'title' => InputSanitizer::sanitizeText($lessonData['title']),
                                'content' => isset($lessonData['content']) ? InputSanitizer::sanitizeHtml($lessonData['content']) : null,
                                'video_url' => $lessonData['video_url'] ?? null,
                                'duration' => $lessonData['duration'] ?? null,
                                'is_free' => $lessonData['is_free'] ?? false,
                                'order' => $lessonIndex + 1,
                                'thumbnail' => $lessonThumbnail,
                                'fileUpload' => $lessonFile,
                            ]);
                        }
                    }
                }
            }

            // Create sessions for live courses
            if (isset($data['sessions']) && is_array($data['sessions'])) {
                foreach ($data['sessions'] as $sessionData) {
                    $startTime = new \DateTime($sessionData['start_time']);
                    $endTime = new \DateTime($sessionData['end_time']);
                    $durationMinutes = ($endTime->getTimestamp() - $startTime->getTimestamp()) / 60;

                    CourseSession::create([
                        'course_id' => $course->courseID,
                        'title' => InputSanitizer::sanitizeText($sessionData['title']),
                        'description' => isset($sessionData['description']) ? InputSanitizer::sanitizeText($sessionData['description']) : null,
                        'session_type' => $sessionData['session_type'] ?? 'online',
                        'meeting_link' => $sessionData['meeting_link'] ?? null,
                        'start_time' => $sessionData['start_time'],
                        'end_time' => $sessionData['end_time'],
                        'duration_minutes' => $durationMinutes,
                        'status' => 'scheduled',
                    ]);
                }
            }

            Log::info('Course created successfully', [
                'instructor_id' => $instructor->id,
                'course_id' => $course->courseID,
                'title' => $course->title,
            ]);

            return redirect()->route('instructor.courses.index')->with('success', 'Course created successfully! Waiting for admin approval.');
        } catch (\Exception $e) {
            Log::error('Failed to create course: ' . $e->getMessage(), [
                'instructor_id' => $instructor->id ?? null,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['thumbnail', 'chapters']),
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to create course: ' . $e->getMessage());
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
                ->withCount('chapters')
                ->withCount('lessons')
                ->withCount('students')
                ->latest()
                ->paginate(10);

            return view('dashboardInstructor.myCourses', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Failed to load courses: ' . $e->getMessage());

            // Return empty paginator instead of collection
            $courses = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                10,
                1
            );

            return view('dashboardInstructor.myCourses', compact('courses'));
        }
    }

    /**
     * Display detail course untuk edit
     */
    public function edit($id)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)
            ->with(['chapters.lessons' => function($query) {
                $query->orderBy('order');
            }])
            ->with(['sessions' => function($query) {
                $query->orderBy('start_time');
            }])
            ->findOrFail($id);

        $categories = \App\Models\Category::all();

        return view('dashboardInstructor.editCourse', compact('course', 'categories'));
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
            'description' => 'nullable|string|max:5000',
            'category_id' => 'nullable|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            // Teaching mode fields
            'teaching_mode' => 'required|in:static,online,offline,hybrid',
            'meeting_platform' => 'nullable|string|max:50',
            'default_meeting_link' => 'nullable|url|max:500',
            'location_name' => 'nullable|string|max:255',
            'location_address' => 'nullable|string|max:1000',
            'location_city' => 'nullable|string|max:100',
            'max_participants' => 'nullable|integer|min:1',
            // Sessions
            'deleted_sessions' => 'nullable|string',
            'existing_sessions' => 'nullable|array',
            'existing_sessions.*.title' => 'required_with:existing_sessions|string|max:255',
            'existing_sessions.*.start_time' => 'required_with:existing_sessions|date',
            'existing_sessions.*.end_time' => 'required_with:existing_sessions|date',
            'existing_sessions.*.session_type' => 'nullable|in:online,offline',
            'existing_sessions.*.meeting_link' => 'nullable|string|max:500',
            'existing_sessions.*.description' => 'nullable|string|max:1000',
            'sessions' => 'nullable|array',
            'sessions.*.title' => 'required_with:sessions|string|max:255',
            'sessions.*.start_time' => 'required_with:sessions|date',
            'sessions.*.end_time' => 'required_with:sessions|date',
            'sessions.*.session_type' => 'nullable|in:online,offline',
            'sessions.*.meeting_link' => 'nullable|string|max:500',
            'sessions.*.description' => 'nullable|string|max:1000',
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
                'description' => array_key_exists('description', $data) ? InputSanitizer::sanitizeHtml($data['description'] ?? '') : $course->description,
                'price' => $data['price'],
                'category_id' => $data['category_id'] ?? $course->category_id,
                'thumbnail' => $data['thumbnail'] ?? $course->thumbnail,
                // Teaching mode fields
                'teaching_mode' => $data['teaching_mode'],
                'meeting_platform' => $data['meeting_platform'] ?? null,
                'default_meeting_link' => $data['default_meeting_link'] ?? null,
                'location_name' => isset($data['location_name']) ? InputSanitizer::sanitizeText($data['location_name']) : null,
                'location_address' => isset($data['location_address']) ? InputSanitizer::sanitizeText($data['location_address']) : null,
                'location_city' => isset($data['location_city']) ? InputSanitizer::sanitizeText($data['location_city']) : null,
                'max_participants' => $data['max_participants'] ?? null,
            ]);

            // Handle sessions
            // Delete sessions marked for deletion with enhanced sanitization
            if (!empty($data['deleted_sessions'])) {
                // Sanitize: filter only valid integers
                $deletedIds = array_filter(
                    explode(',', $data['deleted_sessions']),
                    function($id) {
                        return is_numeric($id) && intval($id) > 0;
                    }
                );

                // Cast to integers for safety
                $deletedIds = array_map('intval', $deletedIds);

                if (!empty($deletedIds)) {
                    // Verify sessions belong to this instructor's course before deleting
                    $validIds = CourseSession::where('course_id', $course->courseID)
                        ->whereIn('id', $deletedIds)
                        ->pluck('id')
                        ->toArray();

                    if (!empty($validIds)) {
                        CourseSession::whereIn('id', $validIds)->delete();
                    }
                }
            }

            // Update existing sessions
            if (isset($data['existing_sessions']) && is_array($data['existing_sessions'])) {
                foreach ($data['existing_sessions'] as $sessionId => $sessionData) {
                    $session = CourseSession::where('course_id', $course->courseID)
                        ->where('id', $sessionId)
                        ->first();

                    if ($session) {
                        $startTime = new \DateTime($sessionData['start_time']);
                        $endTime = new \DateTime($sessionData['end_time']);
                        $durationMinutes = ($endTime->getTimestamp() - $startTime->getTimestamp()) / 60;

                        $session->update([
                            'title' => InputSanitizer::sanitizeText($sessionData['title']),
                            'description' => isset($sessionData['description']) ? InputSanitizer::sanitizeText($sessionData['description']) : null,
                            'session_type' => $sessionData['session_type'] ?? 'online',
                            'meeting_link' => $sessionData['meeting_link'] ?? null,
                            'start_time' => $sessionData['start_time'],
                            'end_time' => $sessionData['end_time'],
                            'duration_minutes' => $durationMinutes,
                        ]);
                    }
                }
            }

            // Create new sessions
            if (isset($data['sessions']) && is_array($data['sessions'])) {
                foreach ($data['sessions'] as $sessionData) {
                    $startTime = new \DateTime($sessionData['start_time']);
                    $endTime = new \DateTime($sessionData['end_time']);
                    $durationMinutes = ($endTime->getTimestamp() - $startTime->getTimestamp()) / 60;

                    CourseSession::create([
                        'course_id' => $course->courseID,
                        'title' => InputSanitizer::sanitizeText($sessionData['title']),
                        'description' => isset($sessionData['description']) ? InputSanitizer::sanitizeText($sessionData['description']) : null,
                        'session_type' => $sessionData['session_type'] ?? 'online',
                        'meeting_link' => $sessionData['meeting_link'] ?? null,
                        'start_time' => $sessionData['start_time'],
                        'end_time' => $sessionData['end_time'],
                        'duration_minutes' => $durationMinutes,
                        'status' => 'scheduled',
                    ]);
                }
            }

            Log::info('Course updated successfully', [
                'instructor_id' => $instructor->id,
                'course_id' => $course->courseID,
            ]);

            return redirect()->route('instructor.courses.edit', $course->courseID)->with('success', 'Course updated successfully!');
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

            // Hapus semua file lessons
            foreach ($course->lessons as $lesson) {
                if ($lesson->thumbnail) {
                    Storage::disk('public')->delete($lesson->thumbnail);
                }
                if ($lesson->fileUpload) {
                    Storage::disk('public')->delete($lesson->fileUpload);
                }
            }

            $course->delete();

            Log::info('Course deleted successfully', [
                'instructor_id' => $instructor->id,
                'course_id' => $course->courseID,
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
     * Store chapter baru
     */
    public function storeChapter(Request $request, $courseId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);

        try {
            $maxOrder = $course->chapters()->max('order') ?? 0;

            Chapter::create([
                'course_id' => $courseId,
                'title' => InputSanitizer::sanitizeText($data['title']),
                'description' => isset($data['description']) ? InputSanitizer::sanitizeText($data['description']) : null,
                'order' => $maxOrder + 1,
            ]);

            Log::info('Chapter created', ['course_id' => $courseId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Chapter added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create chapter: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to add chapter. Please try again.');
        }
    }

    /**
     * Update chapter
     */
    public function updateChapter(Request $request, $courseId, $chapterId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);
        $chapter = Chapter::where('course_id', $courseId)->findOrFail($chapterId);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);

        try {
            $chapter->update([
                'title' => InputSanitizer::sanitizeText($data['title']),
                'description' => isset($data['description']) ? InputSanitizer::sanitizeText($data['description']) : null,
            ]);

            Log::info('Chapter updated', ['chapter_id' => $chapterId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Chapter updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update chapter: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update chapter. Please try again.');
        }
    }

    /**
     * Delete chapter
     */
    public function destroyChapter($courseId, $chapterId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);
        $chapter = Chapter::where('course_id', $courseId)->findOrFail($chapterId);

        try {
            // Hapus semua lesson files dalam chapter
            foreach ($chapter->lessons as $lesson) {
                if ($lesson->thumbnail) {
                    Storage::disk('public')->delete($lesson->thumbnail);
                }
                if ($lesson->fileUpload) {
                    Storage::disk('public')->delete($lesson->fileUpload);
                }
            }

            $chapter->delete();

            Log::info('Chapter deleted', ['chapter_id' => $chapterId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Chapter deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete chapter: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete chapter. Please try again.');
        }
    }

    /**
     * Store lesson baru untuk chapter
     */
    public function storeLesson(Request $request, $courseId, $chapterId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);
        $chapter = Chapter::where('course_id', $courseId)->findOrFail($chapterId);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:10000',
            'video_url' => 'nullable|url|max:500',
            'duration' => 'nullable|integer|min:0',
            'is_free' => 'nullable|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'fileUpload' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,mov,avi|max:51200',
        ]);

        try {
            $thumbnailPath = null;
            $filePath = null;

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store("courses/{$courseId}/lessons/thumbnails", 'public');
            }

            if ($request->hasFile('fileUpload')) {
                $filePath = $request->file('fileUpload')->store("courses/{$courseId}/lessons/files", 'public');
            }

            $maxOrder = $chapter->lessons()->max('order') ?? 0;

            Lesson::create([
                'chapter_id' => $chapterId,
                'course_id' => $courseId,
                'title' => InputSanitizer::sanitizeText($data['title']),
                'content' => isset($data['content']) ? InputSanitizer::sanitizeHtml($data['content']) : null,
                'video_url' => $data['video_url'] ?? null,
                'duration' => $data['duration'] ?? null,
                'is_free' => $request->has('is_free'),
                'order' => $maxOrder + 1,
                'thumbnail' => $thumbnailPath,
                'fileUpload' => $filePath,
            ]);

            Log::info('Lesson created', ['chapter_id' => $chapterId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Lesson added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create lesson: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to add lesson. Please try again.');
        }
    }

    /**
     * Update lesson
     */
    public function updateLesson(Request $request, $courseId, $chapterId, $lessonId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);
        $chapter = Chapter::where('course_id', $courseId)->findOrFail($chapterId);
        $lesson = Lesson::where('chapter_id', $chapterId)->findOrFail($lessonId);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:10000',
            'video_url' => 'nullable|url|max:500',
            'duration' => 'nullable|integer|min:0',
            'is_free' => 'nullable|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'fileUpload' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,mov,avi|max:51200',
        ]);

        try {
            if ($request->hasFile('thumbnail')) {
                if ($lesson->thumbnail) {
                    Storage::disk('public')->delete($lesson->thumbnail);
                }
                $data['thumbnail'] = $request->file('thumbnail')->store("courses/{$courseId}/lessons/thumbnails", 'public');
            }

            if ($request->hasFile('fileUpload')) {
                if ($lesson->fileUpload) {
                    Storage::disk('public')->delete($lesson->fileUpload);
                }
                $data['fileUpload'] = $request->file('fileUpload')->store("courses/{$courseId}/lessons/files", 'public');
            }

            $lesson->update([
                'title' => InputSanitizer::sanitizeText($data['title']),
                'content' => isset($data['content']) ? InputSanitizer::sanitizeHtml($data['content']) : $lesson->content,
                'video_url' => $data['video_url'] ?? $lesson->video_url,
                'duration' => $data['duration'] ?? $lesson->duration,
                'is_free' => $request->has('is_free'),
                'thumbnail' => $data['thumbnail'] ?? $lesson->thumbnail,
                'fileUpload' => $data['fileUpload'] ?? $lesson->fileUpload,
            ]);

            Log::info('Lesson updated', ['lesson_id' => $lessonId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Lesson updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update lesson: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update lesson. Please try again.');
        }
    }

    /**
     * Delete lesson
     */
    public function destroyLesson($courseId, $chapterId, $lessonId)
    {
        $instructor = Auth::guard('instructor')->user();
        $course = Course::where('instructorID', $instructor->id)->findOrFail($courseId);
        $chapter = Chapter::where('course_id', $courseId)->findOrFail($chapterId);
        $lesson = Lesson::where('chapter_id', $chapterId)->findOrFail($lessonId);

        try {
            if ($lesson->thumbnail) {
                Storage::disk('public')->delete($lesson->thumbnail);
            }
            if ($lesson->fileUpload) {
                Storage::disk('public')->delete($lesson->fileUpload);
            }

            $lesson->delete();

            Log::info('Lesson deleted', ['lesson_id' => $lessonId]);

            return redirect()->route('instructor.courses.edit', $courseId)->with('success', 'Lesson deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete lesson. Please try again.');
        }
    }

    /**
     * Display students who purchased instructor's courses
     */
    public function viewStudentPurchases()
    {
        try {
            $instructor = Auth::guard('instructor')->user();

            // Get all courses with enrolled students
            $courses = Course::where('instructorID', $instructor->id)
                ->with(['students' => function($query) {
                    $query->withPivot(['payment_status', 'completion', 'completed', 'created_at', 'id'])
                        ->with('detail')
                        ->orderBy('student_course.created_at', 'desc');
                }])
                ->get();

            // Get pending payments count
            $pendingCount = \DB::table('student_course')
                ->join('courses', 'student_course.courseID', '=', 'courses.courseID')
                ->where('courses.instructorID', $instructor->id)
                ->where('student_course.payment_status', 'pending')
                ->count();

            return view('dashboardInstructor.studentPurchases', compact('instructor', 'courses', 'pendingCount'));
        } catch (\Exception $e) {
            Log::error('Failed to load student purchases: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load student purchases.');
        }
    }

    /**
     * Confirm student payment
     */
    public function confirmPayment(Request $request, $enrollmentId)
    {
        try {
            $instructor = Auth::guard('instructor')->user();

            // Get the enrollment
            $enrollment = \DB::table('student_course')
                ->join('courses', 'student_course.courseID', '=', 'courses.courseID')
                ->where('student_course.id', $enrollmentId)
                ->where('courses.instructorID', $instructor->id)
                ->where('student_course.payment_status', 'pending')
                ->first();

            if (!$enrollment) {
                return redirect()->back()->with('error', 'Enrollment not found or already confirmed.');
            }

            // Update payment status
            \DB::table('student_course')
                ->where('id', $enrollmentId)
                ->update([
                    'payment_status' => 'paid',
                    'updated_at' => now()
                ]);

            Log::info('Payment confirmed by instructor', [
                'instructor_id' => $instructor->id,
                'enrollment_id' => $enrollmentId
            ]);

            return redirect()->back()->with('success', 'Payment confirmed successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to confirm payment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to confirm payment.');
        }
    }

    /**
     * Display settings page
     */
    public function settings()
    {
        try {
            $instructor = Auth::guard('instructor')->user();

            if (!$instructor) {
                return redirect()->route('instructor.login')->with('error', 'Please login first.');
            }

            $instructor->load('detail');

            return view('dashboardInstructor.settingsInstructor', compact('instructor'));
        } catch (\Exception $e) {
            Log::error('Failed to load settings: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load settings.');
        }
    }

    /**
     * Update instructor profile
     */
    public function updateProfile(Request $request)
    {
        try {
            $instructor = Auth::guard('instructor')->user();

            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'gender' => 'required|in:male,female',
                'dob' => 'required|date',
                'country' => 'required|string|max:100'
            ]);

            $instructor->detail()->updateOrCreate(
                ['instructorID' => $instructor->id],
                $validated
            );

            Log::info('Instructor profile updated', ['instructor_id' => $instructor->id]);

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    }

    /**
     * Update instructor password
     */
    public function updatePassword(Request $request)
    {
        try {
            $instructor = Auth::guard('instructor')->user();

            $validated = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed'
            ]);

            // Verify current password
            if (!\Hash::check($validated['current_password'], $instructor->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            $instructor->update([
                'password' => \Hash::make($validated['new_password'])
            ]);

            Log::info('Instructor password updated', ['instructor_id' => $instructor->id]);

            return redirect()->back()->with('success', 'Password updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update password: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update password.');
        }
    }

    /**
     * Delete instructor account
     */
    public function deleteAccount(Request $request)
    {
        try {
            $instructor = Auth::guard('instructor')->user();

            $validated = $request->validate([
                'password' => 'required'
            ]);

            // Verify password
            if (!\Hash::check($validated['password'], $instructor->password)) {
                return redirect()->back()->with('error', 'Password is incorrect.');
            }

            // Delete instructor detail first
            $instructor->detail()->delete();

            // Delete all courses (this will cascade to chapters, lessons, and enrollments)
            Course::where('instructorID', $instructor->id)->delete();

            // Delete instructor account
            $instructor->delete();

            // Logout
            Auth::guard('instructor')->logout();

            Log::info('Instructor account deleted', ['instructor_id' => $instructor->id]);

            return redirect()->route('instructor.login')->with('success', 'Account deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete account: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete account.');
        }
    }
}
