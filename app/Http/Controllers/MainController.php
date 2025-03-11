<?php

namespace App\Http\Controllers;

use App\Models\Hydrant;
use App\Models\InspectionHydrant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function index()
    {
        return view('authentication.login');
    }

    public function admin()
    {

        $session = Auth::check();
        $hydrants = Hydrant::all();

        if (!$session) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $otp = session()->has('otp_verified');

        foreach ($hydrants as $hydrant) {
            $statusHistory = $hydrant->status ?? []; // Langsung gunakan tanpa json_decode
            $hydrant->latest_status = !empty($statusHistory) ? end($statusHistory)['status'] : 0;
        }

        if (!$otp || $otp !== true) {
            return redirect()->route('otp-verif')->withErrors(['error' => 'Silakan verifikasi OTP terlebih dahulu.']);
        }

        return view('dashboard', [
            'session' => $session,
            'user' => $user,
            'hydrants' => $hydrants,
        ]);
    }


    public function hydrant()
    {
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $hydrants = Hydrant::with('inspectionHydrants')
            ->orderBy('id')
            ->paginate(10);

        foreach ($hydrants as $hydrant) {
            $statusHistory = $hydrant->status ?? []; // Langsung gunakan tanpa json_decode
            $hydrant->latest_status = !empty($statusHistory) ? end($statusHistory)['status'] : 0;
        }

        return view('hydrant.hydrant', [
            'user' => Auth::user(),
            'hydrants' => $hydrants,
        ]);
    }
}
