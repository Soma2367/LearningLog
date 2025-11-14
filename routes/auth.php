<?php

use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;

// StudentController
use App\Http\Controllers\Student\Auth\AuthenticatedSessionController as StudentAuthController;
use App\Http\Controllers\Student\Auth\RegisteredUserController as StudentRegisterController;

// TeacherController
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController as TeacherAuthController;
use App\Http\Controllers\Teacher\Auth\RegisteredUserController as TeacherRegisterController;

use Illuminate\Support\Facades\Route;

// Teacher
Route::middleware('guest')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('register', [TeacherRegisterController::class, 'create'])->name('register');
    Route::post('register', [TeacherRegisterController::class, 'store']);
    Route::get('login', [TeacherAuthController::class, 'create'])->name('login');
    Route::post('login', [TeacherAuthController::class, 'store']);
});

// Student
Route::middleware('guest')->prefix('student')->name('student.')->group(function () {
    Route::get('register', [StudentRegisterController::class, 'create'])->name('register');
    Route::post('register', [StudentRegisterController::class, 'store']);
    Route::get('login', [StudentAuthController::class, 'create'])->name('login');
    Route::post('login', [StudentAuthController::class, 'store']);
});

//common
Route::middleware('guest')->group(function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

//common
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});

// Teacher-logout
Route::middleware('auth')->prefix('teacher')->name('teacher.')->group(function() {
    Route::post('logout', [TeacherAuthController::class, 'destroy'])->name('logout');
});

// Student-logout
Route::middleware('auth')->prefix('student')->name('student.')->group(function() {
    Route::post('logout', [StudentAuthController::class, 'destroy'])->name('logout');
});
