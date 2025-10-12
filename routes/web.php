<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/teacherDashboard', function () {
    return view('teacherDashboard');
});

Route::get('/studentDashboard', function () {
    return view('studentDashboard');
});

Route::post('/login', [AuthController::class, 'login'])->name('postlogin');