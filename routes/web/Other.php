<?php

use App\Http\Controllers\Other\CaptchaController;
use Illuminate\Support\Facades\Route;

Route::get('/reload-captcha', [CaptchaController::class, 'reload'])->name('reload_captcha');
