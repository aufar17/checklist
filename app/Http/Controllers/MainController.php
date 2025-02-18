<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function index()
    {
        return view('index');
    }
    public function home()
    {

        $session = Auth::check();
        if ($session) {
            $user = Auth::user();
            $data = [
                'user' => $user,
                'session' => $session,
            ];

            return view('home', $data);
        }

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
    }

    public function hydrant()
    {
        $session = Auth::check();
        if ($session) {
            $user = Auth::user();
            $data = [
                'user' => $user,
                'session' => $session,
            ];

            return view('hydrant', $data);
        }

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }
    }
}
