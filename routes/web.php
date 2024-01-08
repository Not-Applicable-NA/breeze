<?php

use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\subjects\SubjectController;
use App\Http\Controllers\subjects\TakenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

Route::middleware(['auth', 'verified'])->prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'show'])->name('subjects');
    Route::post('/', [SubjectController::class, 'add'])->name('subjects.add');
    Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::patch('/edit/{id}', [SubjectController::class, 'store'])->name('subjects.edit.store');
    Route::get('/delete/{id}', [SubjectController::class, 'delete'])->name('subjects.delete');
    Route::delete('/delete', [SubjectController::class, 'deleteConfirm'])->name('subjects.delete.confirm');
    Route::controller(TakenController::class)->name('subjects.')->group(function () {
        Route::get('/taken', 'show')->name('taken');
        Route::post('/taken', 'add')->name('taken.add');
        Route::delete('/taken', 'delete')->name('taken.delete');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/teachers', [TeacherController::class, 'show'])->name('teachers');
    Route::post('/teachers', [TeacherController::class, 'add'])->name('teachers.add');
    Route::get('/teachers/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::patch('/teachers/{id}', [TeacherController::class, 'store'])->name('teachers.edit.store');
    Route::get('/teachers/delete/{id}', [TeacherController::class, 'delete'])->name('teachers.delete');
    Route::delete('/teachers/delete', [TeacherController::class, 'deleteConfirm'])->name('teachers.delete.confirm');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/semester', [SemesterController::class, 'show'])->name('semester');
    Route::patch('/semester', [SemesterController::class, 'store'])->name('semester.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
