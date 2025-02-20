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
            ->where('expiry_date', '>=', now()) // Cek apakah OTP masih berlaku
            ->latest('created_at') // Ambil OTP terbaru
            ->first();

        // Jika OTP tidak ditemukan, hapus sesi expiry agar tidak error
        if (!$otp) {
            session()->forget('otp_expiry');
            return redirect()->route('login')->withErrors(['error' => 'Tidak ada OTP valid. Silakan coba lagi.']);
        }

        // Jika OTP sudah diverifikasi, redirect ke admin
        if (session('otp_verified', false)) {
            return redirect()->route('admin');
        }

        // Simpan expiry timestamp di session agar tetap konsisten meskipun direfresh
        session(['otp_expiry' => $otp->expiry_date]);

        $data = [
            'otp' => $otp,
            'expiryTimestamp' => strtotime($otp->expiry_date), // Konversi ke timestamp UNIX
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

        // Ambil OTP terbaru yang masih valid untuk user yang login
        $otp = OtpVerification::where('id_user', $user->id)
            ->where('expiry_date', '>=', Carbon::now())
            ->latest('created_at') // Ambil OTP terbaru
            ->first();

        // Debugging untuk memastikan OTP yang ditemukan
        // dd([
        //     'User ID' => $user->id,
        //     'Input OTP' => $request->otp,
        //     'Stored OTP' => $otp ? $otp->otp : 'Tidak ada OTP valid',
        //     'Expiry Date' => $otp ? $otp->expiry_date : 'Tidak ada OTP valid',
        // ]);

        if (!$otp || $otp->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.']);
        }

        $otp->delete();
        session(['otp_verified' => true]);

        return redirect()->route('admin')->with('success', 'OTP berhasil diverifikasi!');
    }
}
