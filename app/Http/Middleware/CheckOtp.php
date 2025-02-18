<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckOtp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check() && !session()->has('otp_verified')) {
        //     session(['show_otp_modal' => true]); // Paksa modal OTP muncul
        //     return redirect()->route('login'); // Kembali ke login (dengan modal OTP)
        // }


        return $next($request);
    }
}
