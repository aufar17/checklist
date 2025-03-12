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
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        $user = Auth::user();
        $hydrants = Hydrant::all();

        $otpVerified = session('otp_verified', false);
        if (!$otpVerified) {
            return redirect()->route('otp-verif')->withErrors(['error' => 'Silakan verifikasi OTP terlebih dahulu.']);
        }

        foreach ($hydrants as $hydrant) {
            $statusHistory = is_array($hydrant->status) ? $hydrant->status : [];
            $hydrant->latest_status = !empty($statusHistory) ? end($statusHistory)['status'] : 0;
        }

        $data = [
            'user' => $user,
            'hydrants' => $hydrants,
        ];

        return view('dashboard', $data);
    }


    public function hydrant()
    {
        $user = Auth::user();
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
            'user' => $user,
            'hydrants' => $hydrants,
        ]);
    }
}
