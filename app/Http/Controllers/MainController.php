<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function admin()
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

        return view('dashboard', $data);
    }


    public function hydrant()
    {
        $session = Auth::check();
        if ($session) {
            $user = Auth::user();
            $data = [
                'user' => $user,
                'session' => $session,
            ];

            return view('hydrant', $data);
        }

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
    }
}
