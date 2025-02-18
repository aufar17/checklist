<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('home', [MainController::class, 'home'])->name('home');
Route::get('two-factor', [LoginController::class, 'twoFactor'])->name('two-factor');

Route::get('/captcha', function () {
    $captcha = Captcha::create('default');
    session(['captcha' => app('captcha')->getPhrase()]); // Simpan captcha di session
    return $captcha;
})->name('captcha');
