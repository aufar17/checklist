<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthService
{
    public function authenticate(Request $request)
    {
        // $request->validate([
        //     'npk' => ['required', 'string'],
        //     'password' => ['required', 'string'],
        // ]);

        // $user = User::where('npk', $request->npk)->first();

        // if ($user && Hash::check($request->password, $user->password)) {
        //     session(['show_otp_modal' => true]);
        //     session(['_user' => $user]);
        //     // return $user;
        // }

        // throw ValidationException::withMessages([
        //     'npk' => ['NPK atau password salah.'],
        // ]);
    }
}
