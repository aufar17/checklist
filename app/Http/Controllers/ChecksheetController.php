<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\HydrantQR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksheetController extends Controller
{
    public function checksheet($id)
    {
        $session = Auth::check();
        if (!$session) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $otp = session()->has('otp_verified');
        $checksheet = HydrantQR::where('id', $id)->first();

        if (!$otp || $otp !== true) {
            return redirect()->route('otp-verif')->withErrors(['error' => 'Silakan verifikasi OTP terlebih dahulu.']);
        }

        $hydrantData = json_decode($checksheet->content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            dd('JSON Error:', json_last_error_msg(), $checksheet->content);
        }

        $data = [
            'session' => $session,
            'user' => $user,
            'checksheet' => $checksheet,
            'hydrantData' => $hydrantData,
        ];

        return view('checksheet', $data);
    }
}
