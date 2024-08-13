<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/student-dashboard', [HomeController::class, 'show_student_profile'])->name('stud.profile');

Route::get('/admin-dashboard', [AdminController::class, 'show_student_detail_form'])->name('admin.profile');
Route::post('/admin-dashboard', [AdminController::class, 'store_students_face_id'])->name('store.admin.profile');


Route::get('/mark-attendance', [AttendanceController::class, 'show_attendance'])->name('stud.attendance');
Route::post('/mark-attendance', [StudentController::class, 'mark_attendance'])->name('stud.mark.attendance');



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
