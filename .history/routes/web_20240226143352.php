<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', [AuthController::class, 'login']);
Route::get("/login", [AuthController::class, "login"])->name("login.index");
Route::post("/auth/login", [AuthController::class, "do_login"])->name('login.do_login');
Route::get("/logout", [AuthController::class, "logout"])->name('logout');
Route::get("/register", [AuthController::class, "register"])->name("register.index");
Route::post("/register", [AuthController::class, "do_register"])->name("register.do_register");
Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgot_password_store'])->name('password.email');
Route::get('/reset-password/{token}',  [AuthController::class, 'reset_password'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset_password_store'])->name('password.update');
