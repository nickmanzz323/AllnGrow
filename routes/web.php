<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InstructorRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\InstructorLoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminInstructorController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\InstructorCourseController;
use App\Http\Controllers\StudentDashboardController;

Route::middleware('web')->group(function () {
    // landing page
    Route::get('/', function () {
        return view('landingPage.landing');
    })->name('home');

    // Student Login
    Route::get('/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentLoginController::class, 'login'])->name('student.login.post')->middleware('throttle:5,1');
    Route::post('/student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

    Route::get('/about', function () {
        return view('landingPage.about');
    })->name('about');

    // Login choice page (student vs instructor)
    Route::get('/get-started', function () {
        return view('landingPage.loginChoice');
    })->name('get-started');

    Route::get('/courses', [CourseController::class, 'course_page'])->name('courses');

    // searching courses (filter)
    Route::get('/search-courses', [CourseController::class, 'search'])->name('courses.search');

    // Course overview & detail
    Route::get('/course/{courseId}', [CourseController::class, 'show'])->name('course.show');

    Route::get('/coursesDetail', function () {
        return view('detailCourses.coursesDetail');
    })->name('coursesDetail');

    // Instructor Login
    Route::get('/loginInstructor', [InstructorLoginController::class, 'showLoginForm'])->name('instructor.login');
    Route::post('/loginInstructor', [InstructorLoginController::class, 'login'])->name('instructor.login.post')->middleware('throttle:5,1');
    Route::post('/instructor/logout', [InstructorLoginController::class, 'logout'])->name('instructor.logout');

    // Admin Login
    Route::get('/loginAdmin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/loginAdmin', [AdminLoginController::class, 'login'])->name('admin.login.post')->middleware('throttle:5,1');
    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Register Instructor & Student (view)
    Route::get('/registerInstructor', function () {
        return view('loginRegisterInstructor.registerInstructor'); 
    })->name('registerInstructor');

    Route::get('/registerInstructorForm', function () {
        return view('loginRegisterInstructor.registerInstructorForm'); 
    })->name('registerInstructorForm');

    Route::get('/register', function () {
        return view('loginRegisterSiswa.register');
    });

    // Register handler (logic)
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register-instructor-step1', [InstructorRegisterController::class, 'registerStep1'])->name('register.instructor.step1');
    Route::post('/register-instructor-step2', [InstructorRegisterController::class, 'registerStep2'])->name('register.instructor.step2');
});

// Protected routes untuk Student (harus login sebagai student)
Route::middleware(['web', 'auth.student'])->group(function () {
    // dashboard student
    Route::get('/dashboardSiswa', [StudentDashboardController::class, 'index'])->name('dashboardSiswa');
    
    // Browse/Find Courses
    Route::get('/student/browse-courses', [StudentDashboardController::class, 'browseCourses'])->name('student.browse-courses');
    
    // Enroll Course
    Route::post('/student/enroll/{courseId}', [StudentDashboardController::class, 'enrollCourse'])->name('student.enroll');
    
    // My Courses
    Route::get('/student/my-courses', [StudentDashboardController::class, 'myCourses'])->name('student.my-courses');
    
    // View Course Detail
    Route::get('/student/course/{courseId}', [StudentDashboardController::class, 'viewCourse'])->name('student.view-course');

    // Course Overview (preview before enrolling)
    Route::get('/student/course-overview/{courseId}', [StudentDashboardController::class, 'courseOverview'])->name('student.course-overview');

    Route::get('/progress', [StudentDashboardController::class, 'progress'])->name('progress');

    Route::get('/schedule', [StudentDashboardController::class, 'schedule'])->name('schedule');

    // Settings
    Route::get('/settings', [StudentDashboardController::class, 'settings'])->name('settings');
    Route::post('/student/update-profile', [StudentDashboardController::class, 'updateProfile'])->name('student.update-profile');
    Route::post('/student/update-password', [StudentDashboardController::class, 'updatePassword'])->name('student.update-password');
    Route::post('/student/delete-account', [StudentDashboardController::class, 'deleteAccount'])->name('student.delete-account');

    // Legacy route (keep for compatibility)
    Route::get('/myCourses', function () {
        return redirect()->route('student.my-courses');
    });
});

// Protected routes untuk Instructor (harus login sebagai instructor)
Route::middleware(['web', 'auth.instructor'])->group(function () {
    // dashboard instructor
    Route::get('/dashboardInstructor', [InstructorCourseController::class, 'dashboard'])->name('dashboardinstructor');

    Route::get('/settingsInstructor', [InstructorCourseController::class, 'settings'])->name('settingsInstructor');
    
    // Settings actions
    Route::post('/instructor/update-profile', [InstructorCourseController::class, 'updateProfile'])->name('instructor.update-profile');
    Route::post('/instructor/update-password', [InstructorCourseController::class, 'updatePassword'])->name('instructor.update-password');
    Route::post('/instructor/delete-account', [InstructorCourseController::class, 'deleteAccount'])->name('instructor.delete-account');


    // Course Management
    Route::get('/instructor/courses', [InstructorCourseController::class, 'index'])->name('instructor.courses.index');
    Route::get('/instructor/my-courses', [InstructorCourseController::class, 'index'])->name('instructor.myCourses'); // Alias
    Route::get('/instructor/courses/create', [InstructorCourseController::class, 'create'])->name('instructor.courses.create');
    Route::get('/instructor/create-course', [InstructorCourseController::class, 'create'])->name('instructor.createCourse'); // Alias
    Route::post('/instructor/courses', [InstructorCourseController::class, 'store'])->name('instructor.courses.store');
    Route::get('/instructor/courses/{id}/edit', [InstructorCourseController::class, 'edit'])->name('instructor.courses.edit');
    Route::put('/instructor/courses/{id}', [InstructorCourseController::class, 'update'])->name('instructor.courses.update');
    Route::delete('/instructor/courses/{id}', [InstructorCourseController::class, 'destroy'])->name('instructor.courses.destroy');
    
    // Subcourse Management
    Route::post('/instructor/courses/{courseId}/subcourses', [InstructorCourseController::class, 'storeSubcourse'])->name('instructor.subcourses.store');
    Route::put('/instructor/courses/{courseId}/subcourses/{subcourseId}', [InstructorCourseController::class, 'updateSubcourse'])->name('instructor.subcourses.update');
    Route::delete('/instructor/courses/{courseId}/subcourses/{subcourseId}', [InstructorCourseController::class, 'destroySubcourse'])->name('instructor.subcourses.destroy');
    
    // Student Purchases & Payment Confirmation
    Route::get('/instructor/student-purchases', [InstructorCourseController::class, 'viewStudentPurchases'])->name('instructor.student-purchases');
    Route::post('/instructor/confirm-payment/{enrollmentId}', [InstructorCourseController::class, 'confirmPayment'])->name('instructor.confirm-payment');
});

// Protected routes untuk Admin (harus login sebagai admin)
Route::middleware(['web', 'auth.admin'])->group(function () {
    // dashboard admin - menampilkan daftar instructor
    Route::get('/dashboardAdmin', [AdminInstructorController::class, 'index'])->name('dashboardAdmin');
    
    // Update status instructor (approve/reject)
    Route::post('/admin/instructor/{id}/update-status', [AdminInstructorController::class, 'updateStatus'])->name('admin.instructor.updateStatus');

    // Delete instructor
    Route::delete('/admin/instructor/{id}', [AdminInstructorController::class, 'destroy'])->name('admin.instructor.destroy');

    // Update status course (approve/reject)
    Route::post('/admin/course/{id}/update-status', [AdminCourseController::class, 'updateStatus'])->name('admin.course.updateStatus');
});
