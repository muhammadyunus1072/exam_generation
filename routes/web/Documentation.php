<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\Documentation\DocumentationController;


Route::middleware('auth')->group(function () {
    Route::group(["controller" => DocumentationController::class, "prefix" => "documentation", "as" => "documentation."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{url}', 'show')->name('index');
    });
});
Route::middleware('guest')->group(function () {
    Route::group(["controller" => DocumentationController::class, "prefix" => "documentation", "as" => "documentation."], function () {
        Route::get('/{url}', 'show')->name('show');
    });
});
