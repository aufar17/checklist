<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\InspectionHydrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function index()
    {
        return view('authentication.login');
    }

    public function admin()
    {

        $session = Auth::check();
        $hydrant = Hydrant::all();
        if (!$session) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $otp = session()->has('otp_verified');

        if (!$otp || $otp !== true) {
            return redirect()->route('otp-verif')->withErrors(['error' => 'Silakan verifikasi OTP terlebih dahulu.']);
        }

        $data = [
            'session' => $session,
            'user' => $user,
            'hydrant' => $hydrant,
        ];

        return view('dashboard', $data);
    }


    public function hydrant()
    {
        $session = Auth::check();
        $hydrants = Hydrant::with('inspectionHydrants')->paginate(10);

        $user = Auth::user();
        $no = ($hydrants->currentPage() - 1) * $hydrants->perPage() + 1;

        if (!$session) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $data = [
            'user' => $user,
            'session' => $session,
            'hydrants' => $hydrants,
            'no' => $no,
        ];

        return view('hydrant.hydrant', $data);
    }
}
