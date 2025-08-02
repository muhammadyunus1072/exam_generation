<?php

use App\Http\Controllers\Service\ExamController;
use App\Http\Controllers\Service\PerformController;
use App\Http\Controllers\Service\PerformRecapController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'access_permission'])->group(function () {
    Route::group(["controller" => ExamController::class, "prefix" => "exam", "as" => "exam."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => PerformRecapController::class, "prefix" => "perform_recap", "as" => "perform_recap."], function () {
        Route::get('{id}', 'index')->name('index');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
    Route::group(["controller" => PerformController::class, "prefix" => "perform", "as" => "perform."], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}/edit', 'edit')->name('edit');
    });
});
