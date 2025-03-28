<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\ChecksheetController;
use App\Http\Controllers\ChecksheetMachineController;
use App\Http\Controllers\HydrantController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MainMachineController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\ValidationController;
use App\Livewire\Kpi;
use App\Models\Hydrant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mews\Captcha\Facades\Captcha;

// HYDRANT

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
Route::get('edit-hydrant/{id}', [HydrantController::class, 'editHydrant'])->name('edit-hydrant');
Route::post('hydrant-post', [HydrantController::class, 'hydrantPost'])->name('hydrant-post');
Route::post('hydrant-update', [HydrantController::class, 'hydrantUpdate'])->name('hydrant-update');
Route::post('hydrant-delete', [HydrantController::class, 'hydrantDelete'])->name('hydrant-delete');
Route::get('detail-hydrant/{id}', [HydrantController::class, 'detailHydrant'])->name('detail-hydrant');
Route::get('hydrant-pdf/{id}', [HydrantController::class, 'hydrantPdf'])->name('hydrant-pdf');


//Validation Features
Route::post('spv-validation', [ValidationController::class, 'spvValidation'])->name('spv-validation');
Route::post('manager-validation', [ValidationController::class, 'managerValidation'])->name('manager-validation');



// MACHINE

//Main Features
Route::get('admin-machine', [MainMachineController::class, 'adminMachine'])->name('admin-machine');
Route::get('machine', [MainMachineController::class, 'machine'])->name('machine');


//Checksheet Machine
Route::get('checksheet-machine/{id}', [ChecksheetMachineController::class, 'checksheet'])->name('checksheet-machine');
Route::post('checksheet-machine-post', [ChecksheetMachineController::class, 'checksheetPost'])->name('checksheet-machine-post');
Route::post('check', [ChecksheetMachineController::class, 'check'])->name('check');

//Machine Features
Route::get('new-machine', [MachineController::class, 'newMachine'])->name('new-machine');
Route::post('machine-post', [MachineController::class, 'machinePost'])->name('machine-post');
Route::get('edit-machine/{id}', [MachineController::class, 'editMachine'])->name('edit-machine');
Route::post('machine-update', [MachineController::class, 'machineUpdate'])->name('machine-update');
Route::post('delete-machine', [MachineController::class, 'machineDelete'])->name('delete-machine');
Route::get('detail-machine/{id}', [MachineController::class, 'detailMachine'])->name('detail-machine');
