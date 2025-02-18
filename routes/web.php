<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;


// Main Features
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('home', [MainController::class, 'home'])->name('home');
Route::get('hydrant', [MainController::class, 'hydrant'])->name('hydrant');

//Login Features
Route::get('two-factor', [LoginController::class, 'twoFactor'])->name('two-factor');
Route::get('/captcha', [CaptchaController::class, 'captcha'])->name('captcha');

// Home Features
Route::post('qr-code', [ScanController::class, 'qrScan'])->name('qr-code');
