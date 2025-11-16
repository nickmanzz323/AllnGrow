<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InstructorRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\InstructorLoginController;

Route::middleware('web')->group(function () {
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
    
    // ini nanti dihapus atau nggak dirapiin logikanya aja, soalnay ini cuma placehorder agar bisa di view di localhost biar lebih gampan
    
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

    Route::get('/overviewcourses', function () {
        return view('/detailCourses/overviewcourses'); 
    })->name('overviewcourses');

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

    // Instructor Login
    Route::get('/loginInstructor', [InstructorLoginController::class, 'showLoginForm'])->name('instructor.login');
    Route::post('/loginInstructor', [InstructorLoginController::class, 'login'])->name('instructor.login.post')->middleware('throttle:5,1');
    Route::post('/instructor/logout', [InstructorLoginController::class, 'logout'])->name('instructor.logout');

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
});
