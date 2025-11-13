<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InstructorRegisterController;

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('/landingPage/landing');
    })->name('home');

    Route::get('/login', function () {
        return view('/loginRegisterSiswa/login');
    })->name('login');

    Route::get('/about', function () {
        return view('/landingPage/about');
    })->name('about');

    Route::get('/courses', function () {
        return view('/landingPage/courses'); 
    })->name('courses');
    
    // ini nanti dihapus atau nggak dirapiin logikanya aja, soalnay ini cuma placehorder agar bisa di view di localhost biar lebih gampan
    
    Route::get('/dashboardSiswa', function () {
        return view('/dashboardSiswa/dashboardSiswa'); 
    })->name('dashboardSiswa');

    Route::get('/progress', function () {
        return view('/dashboardSiswa/progress'); 
    })->name('progress');

    Route::get('/schedule', function () {
        return view('/dashboardSiswa/schedule'); 
    })->name('schedule');

    Route::get('/settings', function () {
        return view('/dashboardSiswa/settings'); 
    })->name('settings');

    Route::get('/myCourses', function () {
        return view('/dashboardSiswa/myCourses'); 
    })->name('myCourses');

    Route::get('/overviewcourses', function () {
        return view('/detailCourses/overviewcourses'); 
    })->name('overviewcourses');

    Route::get('/userprofile', function () {
        return view('userprofile'); 
    })->name('userprofile');

    Route::get('/loginInstructor', function () {
        return view('/loginRegisterInstructor/loginInstructor'); 
    })->name('loginInstructor');

    Route::get('/registerInstructor', function () {
        return view('/loginRegisterInstructor/registerInstructor'); 
    })->name('registerInstructor');

    Route::get('/registerInstructorForm', function () {
        return view('/loginRegisterInstructor/registerInstructorForm'); 
    })->name('registerInstructorForm');

    Route::get('/register', function () {
        return view('/loginRegisterSiswa/register');
    });
    Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register');
    Route::post('/register-instructor', [InstructorRegisterController::class, 'register'])->name('register.instructor');
    
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
    })->middleware('role:teacher');

    Route::get('/studentDashboard', function () {
        return view('studentDashboard');
    })->middleware('role:student');


});
