<?php

use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\QuestionBankController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard Siswa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Group Admin / Guru
Route::middleware(['auth', 'role:guru'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Master Role CRUD
    Route::resource('roles', RoleController::class);

    // Master User (List & Assign Role)
    Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);

    // Master Mata Pelajaran CRUD
    Route::resource('subjects', SubjectController::class);

    // Master Kelas CRUD
    Route::resource('classes', SchoolClassController::class);

    // Master Bank Soal CRUD
    Route::resource('question-banks', QuestionBankController::class);

    // Master Materi CRUD
    Route::resource('materials', MaterialController::class);

    // Master Tugas CRUD
    Route::resource('assignments', AssignmentController::class);
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
