<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Student\DailyStudyLogController;
use App\Http\Controllers\Teacher\TeacherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->isTeacher()) {
        return redirect()->route('teacher.dashboard');
    }
    return redirect()->route('student.daily_study_logs.index');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'teacher'])->prefix('teacher')->name('teacher.')->group(function() {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
     Route::get('/student_logs/{student}', [TeacherController::class, 'studentLogs'])->name('student.logs');
     Route::get('/feedback/{log}', [TeacherController::class, 'showFeedback'])->name('feedback.show');
     Route::post('/feedback/{log}', [TeacherController::class, 'storeFeedback'])->name('feedback.store');
     Route::delete('/student)_logs/{log}', [TeacherController::class, 'deleteLog'])->name('student.log.destroy');
});

Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function() {
    Route::get('/dashboard', function() {
        return view('student.dashboard');
    })->name('dashboard');
    Route::resource('daily_study_logs', DailyStudyLogController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
