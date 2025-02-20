<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (session('otp_required')) {
            return redirect()->route('otp-verif');
        }

        return redirect()->intended(config('fortify.home'));
    }
}
