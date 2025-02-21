<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksheetController extends Controller
{
    public function checksheet()
    {
        $session = Auth::check();
        if (!$session) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $otp = session()->has('otp_verified');

        if (!$otp || $otp !== true) {
            return redirect()->route('otp-verif')->withErrors(['error' => 'Silakan verifikasi OTP terlebih dahulu.']);
        }

        $data = [
            'session' => $session,
            'user' => $user,
        ];

        return view('checksheet', $data);
    }
}
