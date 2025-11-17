<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InstructorRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\InstructorLoginController;
use App\Http\Controllers\CourseController;

Route::middleware('web')->group(function () {
    // landing page
    Route::get('/', function () {
        return view('/landingPage/landing');
    })->name('home');

    // Student Login
    Route::get('/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentLoginController::class, 'login'])->name('student.login.post')->middleware('throttle:5,1');
    Route::post('/student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

    Route::get('/about', function () {
        return view('/landingPage/about');
    })->name('about');

    Route::get('/courses', function () {
        return view('/landingPage/courses'); 
    })->name('courses');

    // searching courses (filter)
    Route::get('/search-courses', [CourseController::class, 'search'])->name('search.courses');

    // Course overview & detail
    Route::get('/overviewcourses', function () {
        return view('/detailCourses/overviewcourses'); 
    })->name('overviewcourses');

    Route::get('/coursesDetail', function () {
        return view('/detailCourses/coursesDetail'); 
    })->name('coursesDetail');

    // Instructor Login
    Route::get('/loginInstructor', [InstructorLoginController::class, 'showLoginForm'])->name('instructor.login');
    Route::post('/loginInstructor', [InstructorLoginController::class, 'login'])->name('instructor.login.post')->middleware('throttle:5,1');
    Route::post('/instructor/logout', [InstructorLoginController::class, 'logout'])->name('instructor.logout');

    // Login & Dashboard Admin (sementara tanpa middleware auth khusus)
    Route::get('/loginAdmin', function () {
        return view('/loginAdmin/loginAdmin'); 
    })->name('loginAdmin');

    Route::get('/dashboardAdmin', function () {
        return view('/dashboardAdmin/dashboardAdmin'); 
    })->name('dashboardAdmin');

    // Register Instructor & Student (view)
    Route::get('/registerInstructor', function () {
        return view('/loginRegisterInstructor/registerInstructor'); 
    })->name('registerInstructor');

    Route::get('/registerInstructorForm', function () {
        return view('/loginRegisterInstructor/registerInstructorForm'); 
    })->name('registerInstructorForm');

    Route::get('/register', function () {
        return view('/loginRegisterSiswa/register');
    });

    // Register handler (logic)
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register-instructor', [InstructorRegisterController::class, 'register'])->name('register.instructor');
});

// Protected routes untuk Student (harus login sebagai student)
Route::middleware(['web', 'auth.student'])->group(function () {
    // dashboard student
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
});

// Protected routes untuk Instructor (harus login sebagai instructor)
Route::middleware(['web', 'auth.instructor'])->group(function () {
    // dashboard instructor
    Route::get('/dashboardInstructor', function () {
        return view('/dashboardInstructor/dashboardInstructor'); 
    })->name('dashboardinstructor');

    Route::get('/messageInstructor', function () {
        return view('/dashboardInstructor/messageInstructor'); 
    })->name('messageInstructor');

    Route::get('/settingsInstructor', function () {
        return view('/dashboardInstructor/settingsInstructor'); 
    })->name('settingsInstructor');
});
