<?php

namespace App\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mews\Captcha\Facades\Captcha;

class CaptchaController extends Controller
{
    public function captcha()
    {
        if (!session()->has('captcha')) {
            session(['captcha' => rand(10000, 99999)]);
        }

        $captcha = session('captcha');
        return $captcha;
    }
}
