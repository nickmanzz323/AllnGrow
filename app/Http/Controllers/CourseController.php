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

        $courses = Course::where('status', 'approved')
            ->with(['category', 'instructor', 'subcourses', 'students'])
            ->withCount(['subcourses', 'students'])
            ->latest()
            ->simplePaginate(9);

        $categories = Category::orderBy('name')->get();
        $partners = Partner::orderBy('name')->get();

        return view('landingPage.courses',
        ['courses' => $courses,
        'categories' => $categories,
        'partners' => $partners,
        'category' => null,
        'partner' => null]);
    }

    function search(Request $request){
        $search = $request->input('search');
        $category = $request->input('category');
        $partner = $request->input('partner');
        $price = $request->input('price');

        $query = Course::where('status', 'approved')
            ->with(['category', 'instructor', 'subcourses', 'students'])
            ->withCount(['subcourses', 'students']);

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

        $courses = $query->latest()->simplePaginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $partners = Partner::orderBy('name')->get();

        return view('landingPage.courses',
            ['courses' => $courses,
            'category' => $category,
            'categories' => $categories,
            'partner' => $partner,
            'partners' => $partners]);
    }

    function show($courseId)
    {
        $course = Course::where('status', 'approved')
            ->with(['category', 'instructor.detail', 'subcourses', 'students', 'ratings'])
            ->withCount(['subcourses', 'students'])
            ->findOrFail($courseId);

        return view('detailCourses.overviewcourses', compact('course'));
    }
}
