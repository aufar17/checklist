<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\ChecksheetController;
use App\Http\Controllers\HydrantController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ScanController;
use App\Models\Hydrant;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;

// Main Features
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('admin', [MainController::class, 'admin'])->name('admin');
Route::get('hydrant', [MainController::class, 'hydrant'])->name('hydrant');

//Login Features
Route::get('captcha', [CaptchaController::class, 'captcha'])->name('captcha');
Route::get('home', [OtpController::class, 'otpVerif'])->name('otp-verif');
Route::post('verify-otp', [OtpController::class, 'verify'])->name('verify-otp');
Route::post('resend-otp', [OtpController::class, 'resendOtp'])->name('resend-otp');

// Home Features
Route::post('scan-process', [ScanController::class, 'scanProcess'])->name('scan-process');
Route::get('scan', [ScanController::class, 'scan'])->name('scan');

//Checksheet
Route::get('checksheet/{id}', [ChecksheetController::class, 'checksheet'])->name('checksheet');
Route::post('checksheet-post', [ChecksheetController::class, 'checksheetPost'])->name('checksheet-post');

// Hydrant Features
Route::get('new-hydrant', [HydrantController::class, 'newHydrant'])->name('new-hydrant');
Route::post('hydrant-post', [HydrantController::class, 'hydrantPost'])->name('hydrant-post');
Route::get('detail-hydrant/{id}', [HydrantController::class, 'detailHydrant'])->name('detail-hydrant');
Route::get('hydrant-pdf/{id}', [HydrantController::class, 'hydrantPdf'])->name('hydrant-pdf');
