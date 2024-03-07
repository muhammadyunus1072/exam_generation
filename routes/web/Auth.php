<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login']);
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::get("/logout", [AuthController::class, "logout"])->name('logout');
    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('password.request');
    Route::get('/reset-password/{token}',  [AuthController::class, 'reset_password'])->name('password.reset');
    Route::get("/email_verification", [AuthController::class, "email_verification"])->name("verification.index");
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, "email_verification_verify"])->middleware('signed')->name('verification.verify');
});

Route::middleware('auth')->group(function () {
    Route::get("/logout", [AuthController::class, "logout"])->name('logout');
});
