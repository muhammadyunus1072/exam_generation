<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\PermissionController;


Route::middleware('auth')->group(function () {
    Route::group(["controller" => DashboardController::class, "prefix" => "dashboard", "as" => "dashboard."], function () {
        Route::get('/', 'index')->name('index');
    });

    Route::group(["controller" => UserController::class, "prefix" => "users", "as" => "users."], function () {
        Route::get('/', 'index')->name('index');

        Route::get('/roles/get', [RoleController::class, 'getRoles'])->name('get.roles');
    });
    Route::group(["controller" => RoleController::class, "prefix" => "roles", "as" => "roles."], function () {
        Route::get('/', 'index')->name('index');

        Route::get('/permissions/get', [PermissionController::class, 'getPermissions'])->name('get.permissions');
    });
    Route::group(["controller" => PermissionController::class, "prefix" => "permissions", "as" => "permissions."], function () {
        Route::get('/', 'index')->name('index');
    });
});
