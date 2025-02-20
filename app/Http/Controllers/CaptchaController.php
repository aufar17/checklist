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
        $captcha = Captcha::create('default');
        session(['captcha' => app('captcha')->getPhrase()]);
        return $captcha;
    }
}
    