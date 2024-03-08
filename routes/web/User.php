<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\PermissionController;


Route::middleware(['auth', 'access_permission'])->group(function () {
    Route::group(["controller" => UserController::class, "prefix" => "user", "as" => "user."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'index')->name('create');
        Route::get('{id}/edit', 'index')->name('edit');

        Route::get('/roles/get', [RoleController::class, 'getRoles'])->name('get.roles');
    });

    Route::group(["controller" => RoleController::class, "prefix" => "role", "as" => "role."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'index')->name('create');
        Route::get('{id}/edit', 'index')->name('edit');

        Route::get('find/permission', [PermissionController::class, 'getPermissions'])->name('find.permission');
    });

    Route::group(["controller" => PermissionController::class, "prefix" => "permission", "as" => "permission."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'index')->name('create');
        Route::get('{id}/edit', 'index')->name('edit');
    });
});
