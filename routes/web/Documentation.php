<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documentation\DocumentationController;

Route::middleware(['auth', 'access_permission'])->group(function () {
    Route::group(["controller" => DocumentationController::class, "prefix" => "documentation", "as" => "documentation."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show', 'show')->name('show');
    });
});