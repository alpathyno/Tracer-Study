<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\TracerStudyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniManagementController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminUserController;

// ============================================================
// LANDING PAGE — publik, tidak perlu login
// ============================================================
Route::get('/', [LandingController::class, 'index'])->name('landing');

// ============================================================
// AUTH — hanya untuk guest (belum login)
// ============================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================================
// PROTECTED — harus login
// ============================================================
Route::middleware('auth')->group(function () {

    // Alumni
    Route::get('/alumni/dashboard', [AlumniController::class, 'dashboard'])->name('alumni.dashboard')->middleware(\App\Http\Middleware\CheckRole::class.':alumni');
    Route::get('/alumni/profile', [AlumniController::class, 'profile'])->name('alumni.profile')->middleware(\App\Http\Middleware\CheckRole::class.':alumni');
    Route::put('/alumni/profile', [AlumniController::class, 'updateProfile'])->name('alumni.profile.update')->middleware(\App\Http\Middleware\CheckRole::class.':alumni');
    Route::get('/tracer/create', [TracerStudyController::class, 'create'])->name('tracer.create')->middleware(\App\Http\Middleware\CheckRole::class.':alumni');
    Route::post('/tracer', [TracerStudyController::class, 'store'])->name('tracer.store')->middleware(\App\Http\Middleware\CheckRole::class.':alumni');
    Route::get('/tracer/edit', [TracerStudyController::class, 'edit'])->name('tracer.edit')->middleware(\App\Http\Middleware\CheckRole::class.':alumni');
    Route::put('/tracer', [TracerStudyController::class, 'update'])->name('tracer.update')->middleware(\App\Http\Middleware\CheckRole::class.':alumni');

    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::get('/admin/alumni', [AlumniManagementController::class, 'index'])->name('admin.alumni.index')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::get('/admin/alumni/{id}', [AlumniManagementController::class, 'show'])->name('admin.alumni.show')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::delete('/admin/alumni/{id}', [AlumniManagementController::class, 'destroy'])->name('admin.alumni.destroy')->middleware(\App\Http\Middleware\CheckRole::class.':admin');

    // Admin CRUD
    Route::get('/admin/admins', [\App\Http\Controllers\AdminManagementController::class, 'index'])->name('admin.admins.index')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::get('/admin/admins/create', [\App\Http\Controllers\AdminManagementController::class, 'create'])->name('admin.admins.create')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::post('/admin/admins', [\App\Http\Controllers\AdminManagementController::class, 'store'])->name('admin.admins.store')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::get('/admin/admins/{id}/edit', [\App\Http\Controllers\AdminManagementController::class, 'edit'])->name('admin.admins.edit')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::put('/admin/admins/{id}', [\App\Http\Controllers\AdminManagementController::class, 'update'])->name('admin.admins.update')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
    Route::delete('/admin/admins/{id}', [\App\Http\Controllers\AdminManagementController::class, 'destroy'])->name('admin.admins.destroy')->middleware(\App\Http\Middleware\CheckRole::class.':admin');
});