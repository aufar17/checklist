<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainMachineController extends Controller
{
    public function adminMachine()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('machine.dashboard-machine', $data);
    }
}
