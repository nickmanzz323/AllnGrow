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

        $courses=Course::simplePaginate(6);
        $categories=Category::orderBy('name')->get();
        $partners=Partner::orderBy('name')->get();

        return view('landingPage.courses', 
        ['courses'=>$courses,
        'categories'=>$categories, 
        'partners'=>$partners,
        'category'=>null, 'partner'=>null]); 
    }

    function search(Request $request){
        $search = $request->input('search');
        $category = $request->input('category');
        $partner= $request->input('partner');

        $query = Course::query();
        // filter by title
        if($search){
            $query->where('title', 'LIKE', '%'.$search.'%');
        }

        if($category){
            $query->whereHas('category', function($q) use ($category){
                $q->where('name', $category);
            });
            // $query->where('category', $category);
        }

        if($partner){
            $query->whereHas('partner', function($q) use ($partner){
                $q->where('name', $partner);
            });
        }

        $courses=$query->simplePaginate(6)->withQueryString();
        $categories=Category::orderBy('name')->get();
        $partners=Partner::orderBy('name')->get();

        return view('landingPage.courses', 
            ['courses'=>$courses, 
            'category'=>$category, 
            'categories'=>$categories, 
            'partner'=>$partner,
            'partners'=>$partners]);
    }
}
