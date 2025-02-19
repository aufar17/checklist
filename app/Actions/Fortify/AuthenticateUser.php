<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\LoginResponse;
use Mews\Captcha\Facades\Captcha;

class AuthenticateUser
{
    public function handle(Request $request)
    {
        $request->validate([
            'npk'    => 'required|string',
            'password' => 'required|string',
            'captcha'  => 'required|captcha',
        ]);

        if (!Auth::attempt($request->only('npk', 'password'), $request->boolean('remember'))) {
            return redirect()->route('login')->with('error', 'Username atau password salah!');
        }

        Auth::user();
        return app(LoginResponse::class);
    }
}
