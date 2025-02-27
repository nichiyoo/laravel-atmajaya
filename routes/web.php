<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('/', fn() => redirect()->route(Auth::user()->role . '.dashboard'))->name('dashboard');
  Route::get('/search', fn() => redirect()->route(Auth::user()->role . '.dashboard'))->name('search');
});

Route::middleware(['auth', 'role:admin'])
  ->prefix('admin')
  ->as('admin.')
  ->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [App\Http\Controllers\DashboardController::class, 'search'])->name('search');

    Route::resource('courses', App\Http\Controllers\CourseController::class);
    Route::resource('students', App\Http\Controllers\StudentController::class);
    Route::resource('students.semesters', \App\Http\Controllers\SemesterController::class)->except(['index', 'show']);
  });


Route::middleware(['auth', 'role:student'])
  ->prefix('student')
  ->as('student.')
  ->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [App\Http\Controllers\Student\DashboardController::class, 'search'])->name('search');

    Route::get('/semesters/full', [App\Http\Controllers\Student\SemesterController::class, 'full'])->name('semesters.full');
    Route::resource('semesters', \App\Http\Controllers\Student\SemesterController::class)->only(['index', 'show']);
  });
