<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

Route::get("/email_verification", [AuthController::class, "email_verification"])->name("verification.index");
Route::post("/email_verification", [AuthController::class, "email_verification_store"])->name("verification.store");
Route::get('/email/verify/{id}/{hash}', [AuthController::class, "email_verification_verify"])->middleware('signed')->name('verification.verify');
Route::get('/reload-captcha', [AuthController::class, 'reload_captcha'])->name('reload_captcha');

Route::group(["controller" => DashboardController::class, "prefix" => "dashboard", "as" => "dashboard."], function () {
    Route::get('/', 'index')->name('index');
});
Route::middleware('role:member')->group(function () {
    Route::group(["controller" => DashboardController::class, "prefix" => "dashboard", "as" => "dashboard."], function () {
        Route::get('/', 'index')->name('index');
    });
});
Route::middleware('role:admin')->group(function () {
    Route::group(["controller" => DashboardController::class, "prefix" => "dashboard", "as" => "dashboard."], function () {
        Route::get('/', 'index')->name('index');
    });
    Route::group(["controller" => UserController::class, "prefix" => "users", "as" => "users."], function () {
        Route::get('/', 'index')->name('index');

        Route::get('/roles/get', [UserController::class, 'getRoles'])->name('get.roles');
    });
    Route::group(["controller" => UserController::class, "prefix" => "roles_and_permissions", "as" => "roles_and_permissions."], function () {
        Route::get('/', 'index')->name('index');
    });

});