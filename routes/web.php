<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'show'])->name('subjects');
    Route::post('/', [SubjectController::class, 'add'])->name('subjects.add');
    Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::patch('/edit/{id}', [SubjectController::class, 'store'])->name('subjects.edit.store');
    Route::controller(TakenController::class)->name('subjects.')->group(function () {
        Route::get('/taken', 'show')->name('taken');
        Route::post('/taken', 'add')->name('taken.add');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/teachers', [TeacherController::class, 'show'])->name('teachers');
    Route::post('/teachers', [TeacherController::class, 'add'])->name('teachers.add');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
