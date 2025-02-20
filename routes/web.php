<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;


// Main Features
Route::get('/', [MainController::class, 'index'])->name('index');
// Route::middleware(['auth', 'otp'])->group(function () {
Route::get('admin', [MainController::class, 'admin'])->name('admin');
// });
Route::get('hydrant', [MainController::class, 'hydrant'])->name('hydrant');

//Login Features
Route::get('home', [OtpController::class, 'otpVerif'])->name('otp-verif');
Route::post('verify-otp', [OtpController::class, 'verify'])->name('verify-otp');
Route::get('captcha', [CaptchaController::class, 'captcha'])->name('captcha');

// Home Features
Route::post('qr-code', [ScanController::class, 'qrScan'])->name('qr-code');
Route::get('scan', [ScanController::class, 'scan'])->name('scan');
