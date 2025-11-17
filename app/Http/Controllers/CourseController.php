<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{

    //
    function search(Request $request){
        $category = $request->input('category');
        $partner = $request->input('partner');
    }
}
