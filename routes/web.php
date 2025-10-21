<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('landing');
    })->name('home');

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/courses', function () {
        return view('courses'); 
    })->name('courses');
    
    // ini nanti dihapus atau nggak dirapiin logikanya aja, soalnay ini cuma placehorder agar bisa di view di localhost biar lebih gampang
    Route::get('/overviewcourses', function () {
        return view('overviewcourses'); 
    })->name('overviewcourses');

    Route::get('/userprofile', function () {
        return view('userprofile'); 
    })->name('userprofile');

    Route::get('/loginInstructor', function () {
        return view('loginInstructor'); 
    })->name('loginInstructor');

    Route::get('/registerInstructor', function () {
        return view('registerInstructor'); 
    })->name('registerInstructor');

    Route::get('/instructorRegisterForm', function () {
        return view('instructorRegisterForm'); 
    })->name('instructorRegisterForm');

    
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register');
    
    // Authentication form handlers
    Route::post('/login', [LoginController::class, 'postLogin'])->name('postlogin')->middleware('throttle:5,1');
    Route::post('/logout', function (\Illuminate\Http\Request $request) {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/teacherDashboard', function () {
        return view('teacherDashboard');
    });

    Route::get('/studentDashboard', function () {
        return view('studentDashboard');
    });


});
