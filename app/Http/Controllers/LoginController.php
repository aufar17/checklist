<?php

namespace App\Http\Controllers;

use App\Models\HydrantQR;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $authService;

    // public function twoFactor(Request $request)
    // {
    //     $user = $request->user();

    //     if ($user->two_factor_secret) {
    //         $user->disableTwoFactorAuthentication();
    //     } else {
    //         $user->enableTwoFactorAuthentication();
    //     }
    // }
}
