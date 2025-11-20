<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Partner;

class CourseController extends Controller
{

    //
    function course_page() {

        // Get top 3 popular courses based on enrolled students count (for main section)
        $courses = Course::where('status', 'approved')
            ->with(['category', 'instructor', 'chapters.lessons', 'students'])
            ->withCount(['chapters', 'lessons', 'students'])
            ->orderBy('students_count', 'desc')
            ->limit(3)
            ->get();

        // Get top 5 popular courses based on enrolled students count (for horizontal scroll)
        $topCourses = Course::where('status', 'approved')
            ->withCount('students')
            ->with(['instructor.detail', 'category'])
            ->orderBy('students_count', 'desc')
            ->limit(5)
            ->get();

        $categories = Category::orderBy('name')->get();
        $partners = Partner::orderBy('name')->get();

        return view('landingPage.courses',
        ['courses' => $courses,
        'topCourses' => $topCourses,
        'categories' => $categories,
        'partners' => $partners,
        'category' => null,
        'partner' => null]);
    }

    function search(Request $request){
        // Validate input to prevent injection and invalid data
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'partner' => 'nullable|string|max:100',
            'price' => 'nullable|in:free,paid',
        ]);

        $search = $validated['search'] ?? null;
        $category = $validated['category'] ?? null;
        $partner = $validated['partner'] ?? null;
        $price = $validated['price'] ?? null;

        $query = Course::where('status', 'approved')
            ->with(['category', 'instructor', 'chapters.lessons', 'students'])
            ->withCount(['chapters', 'lessons', 'students']);

        // filter by title or description
        if($search){
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', '%'.$search.'%')
                  ->orWhere('description', 'LIKE', '%'.$search.'%');
            });
        }

        // filter by category
        if($category){
            $query->whereHas('category', function($q) use ($category){
                $q->where('name', $category);
            });
        }

        // filter by partner
        if($partner){
            $query->whereHas('partner', function($q) use ($partner){
                $q->where('name', $partner);
            });
        }

        // filter by price
        if($price){
            if($price === 'free'){
                $query->where('price', 0);
            } elseif($price === 'paid'){
                $query->where('price', '>', 0);
            }
        }

        $courses = $query->latest()->simplePaginate(3)->withQueryString();

        // Get top 5 popular courses based on enrolled students count
        $topCourses = Course::where('status', 'approved')
            ->withCount('students')
            ->with(['instructor.detail', 'category'])
            ->orderBy('students_count', 'desc')
            ->limit(5)
            ->get();

        $categories = Category::orderBy('name')->get();
        $partners = Partner::orderBy('name')->get();

        return view('landingPage.courses',
            ['courses' => $courses,
            'topCourses' => $topCourses,
            'category' => $category,
            'categories' => $categories,
            'partner' => $partner,
            'partners' => $partners]);
    }

    function show($courseId)
    {
        $course = Course::where('status', 'approved')
            ->with(['category', 'instructor.detail', 'chapters.lessons', 'students', 'ratings'])
            ->withCount(['chapters', 'lessons', 'students'])
            ->findOrFail($courseId);

        return view('detailCourses.overviewcourses', compact('course'));
    }
}
