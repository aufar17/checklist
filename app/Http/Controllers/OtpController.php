<?php

namespace App\Http\Controllers;

use App\Models\OtpVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function otpVerif()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $otp = OtpVerification::where('id_user', $user->id)
            ->where('expiry_date', '>=', now())
            ->latest('created_at')
            ->first();

        if (!$otp) {
            session()->forget('otp_expiry');
            return redirect()->route('login')->withErrors(['error' => 'Tidak ada OTP valid. Silakan coba lagi.']);
        }

        if (session('otp_verified', false)) {
            return redirect()->route('admin');
        }

        session(['otp_expiry' => $otp->expiry_date]);

        $data = [
            'otp' => $otp,
            'expiryTimestamp' => strtotime($otp->expiry_date),
        ];

        return view('otp-verification', $data);
    }


    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Session expired. Silakan login kembali.']);
        }

        $otp = OtpVerification::where('id_user', $user->id)
            ->where('expiry_date', '>=', Carbon::now())
            ->latest('created_at')
            ->first();

        if (!$otp || $otp->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.']);
        }

        $otp->delete();
        session(['otp_verified' => true]);

        return redirect()->route('admin')->with('success', 'OTP berhasil diverifikasi!');
    }

    public function resendOtp()
    {
        $user = Auth::user();

        OtpVerification::where('id_user', $user->id)
            ->where('expiry_date', '>=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->delete();


        $newOtp = OtpVerification::create([
            'id_user'     => $user->id,
            'otp'         => rand(100000, 999999),
            'expiry_date' => Carbon::now()->addMinutes(5),
            'send'        => 'sent',
            'send_date'   => Carbon::now(),
            'use'         => false,
            'use_date'    => null,
        ]);

        session([
            'otp_required' => true,
            'otp_expiry'   => $newOtp->expiry_date,
        ]);

        return redirect()->route('otp-verif')->with('message', 'OTP berhasil dikirim ulang.');
    }
}
