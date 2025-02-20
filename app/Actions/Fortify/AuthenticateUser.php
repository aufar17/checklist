<?php

namespace App\Actions\Fortify;

use App\Models\OtpVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\LoginResponse;
use Mews\Captcha\Facades\Captcha;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class AuthenticateUser
{
    public function handle(Request $request)
    {
        $request->validate([
            'npk'      => 'required|string',
            'password' => 'required|string',
            'captcha'  => 'required|captcha',
        ]);

        if (!Auth::attempt($request->only('npk', 'password'), $request->boolean('remember'))) {
            return redirect()->route('login')->with('error', 'Username atau password salah!');
        }

        $user = Auth::user();

        $otp = OtpVerification::where('id_user', $user->id)
            ->where('expiry_date', '>=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();


        if (!$otp) {
            OtpVerification::create([
                'id_user'     => $user->id,
                'otp'         => rand(100000, 999999),
                'expiry_date' => Carbon::now()->addMinutes(5),
                'send'        => 'sent',
                'send_date'   => Carbon::now(),
                'use'         => false,
                'use_date'    => null,
            ]);
        }

        session(['otp_required' => true]);

        return app(LoginResponseContract::class);
    }
}
